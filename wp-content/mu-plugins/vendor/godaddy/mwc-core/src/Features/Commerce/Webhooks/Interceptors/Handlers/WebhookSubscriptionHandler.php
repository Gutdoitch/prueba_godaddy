<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\Handlers;

use DateTime;
use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Common\Schedule\Exceptions\InvalidScheduleException;
use GoDaddy\WordPress\MWC\Common\Schedule\Schedule;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\Contracts\CommerceContextContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Cache\WebhookSubscriptionCache;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Configuration\Contracts\CommerceWebhooksRuntimeConfigurationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\CreateWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\DeleteWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\UpdateWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\WebhookSubscriptionsInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Providers\DataObjects\Subscription;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Repositories\WebhookSubscriptionRepository;
use GoDaddy\WordPress\MWC\Core\Interceptors\Handlers\AbstractInterceptorHandler;

/**
 * Handler for {@see WebhookSubscriptionsInterceptor}.
 *
 * This class is responsible for determining if the site's current webhook subscription matches our expectations (exists
 * when it should, doesn't exist when it shouldn't, and has all the correct event types). If there are any discrepancies
 * then this class will dispatch a background job to resolve them.
 */
class WebhookSubscriptionHandler extends AbstractInterceptorHandler
{
    protected WebhookSubscriptionRepository $webhookSubscriptionRepository;
    protected CommerceContextContract $commerceContext;
    protected CommerceWebhooksRuntimeConfigurationContract $runtimeConfiguration;

    public function __construct(
        WebhookSubscriptionRepository $webhookSubscriptionRepository,
        CommerceContextContract $commerceContext,
        CommerceWebhooksRuntimeConfigurationContract $runtimeConfiguration
    ) {
        $this->webhookSubscriptionRepository = $webhookSubscriptionRepository;
        $this->commerceContext = $commerceContext;
        $this->runtimeConfiguration = $runtimeConfiguration;
    }

    /**
     * Ensures the webhook subscription matches our expectations, by creating/updating/deleting as necessary.
     *
     * NOTE: This code makes two assumptions that we may wish to change/address in the future, depending on need:
     *   1. That the local database record matches the remote API record. In the future we may wish to do periodic API
     *      requests to sync this data.
     *   2. That each context (store ID) has only one webhook subscription for the current site.
     *
     * {@inheritDoc}
     */
    public function run(...$args)
    {
        try {
            $existingSubscription = $this->getExistingWebhookSubscription();
            $expectedEventTypes = $this->runtimeConfiguration->getEnabledWebhookEventTypeNames();

            if ($this->shouldCreateSubscription($existingSubscription, $expectedEventTypes)) {
                $this->scheduleJobToCreateSubscription();
            } elseif ($this->shouldDeleteSubscription($existingSubscription, $expectedEventTypes)) {
                $this->scheduleJobToDeleteSubscription($existingSubscription);
            } elseif ($this->shouldUpdateExistingSubscription($existingSubscription, $expectedEventTypes)) { // @phpstan-ignore-line for some reason it thinks we're passing through `null` always, when we're not. I think related to the `assert-if-true` usage
                $this->scheduleJobToUpdateSubscription($existingSubscription);
            }
        } catch (Exception $e) {
            // catch exceptions in hook callbacks
            SentryException::getNewInstance($e->getMessage(), $e);
        }
    }

    /**
     * Gets the existing webhook subscription for the current site, if one exists.
     *
     * @return Subscription|null
     * @throws BaseException
     */
    protected function getExistingWebhookSubscription() : ?Subscription
    {
        $contextId = $this->commerceContext->getId();

        if (! $contextId) {
            throw new BaseException('Site is missing a context.');
        }

        $cache = WebhookSubscriptionCache::getInstance((string) $contextId);

        $subscription = $cache->remember(fn () => $this->webhookSubscriptionRepository->getSubscriptionByContextId($contextId));

        return ($subscription instanceof Subscription) ? $subscription : null;
    }

    /**
     * Determines whether the site should create a new webhook subscription.
     *
     * This will return true if a webhook subscription does not yet exist, and the expected event types are not empty.
     *
     * @param Subscription|null $existingSubscription
     * @param string[] $expectedEventTypes
     *
     * @return bool
     */
    protected function shouldCreateSubscription(?Subscription $existingSubscription, array $expectedEventTypes) : bool
    {
        return empty($existingSubscription) && ! empty($expectedEventTypes);
    }

    /**
     * Schedules a background job to create a webhook subscription for the current context.
     *
     * @return void
     * @throws InvalidScheduleException
     */
    protected function scheduleJobToCreateSubscription() : void
    {
        $job = Schedule::singleAction()
            ->setName(CreateWebhookSubscriptionJobInterceptor::JOB_NAME)
            ->setScheduleAt(new DateTime('now'));

        if (! $job->isScheduled()) {
            $job->schedule();
        }
    }

    /**
     * Determines whether the site should delete an existing subscription.
     *
     * This will return true if the site has a subscription with non-empty event types, but the expected array of
     * event types is empty.
     *
     * @param Subscription|null $existingSubscription
     * @param string[] $expectedEventTypes
     * @return bool
     * @phpstan-assert-if-true Subscription $existingSubscription
     */
    protected function shouldDeleteSubscription(?Subscription $existingSubscription, array $expectedEventTypes) : bool
    {
        return ! empty($existingSubscription) && ! empty($existingSubscription->eventTypes) && empty($expectedEventTypes);
    }

    /**
     * Schedules a background job to delete the webhook subscription for the current context.
     *
     * @param Subscription $subscription
     * @return void
     * @throws InvalidScheduleException
     */
    protected function scheduleJobToDeleteSubscription(Subscription $subscription) : void
    {
        $job = Schedule::singleAction()
            ->setName(DeleteWebhookSubscriptionJobInterceptor::JOB_NAME)
            ->setArguments($subscription->id)
            ->setScheduleAt(new DateTime('now'));

        if (! $job->isScheduled()) {
            $job->schedule();
        }
    }

    /**
     * Determines whether the site should update an existing webhook subscription.
     *
     * This will return true if a site has a subscription but the event types does not match the expected event types.
     *
     * @param Subscription|null $existingSubscription
     * @param string[] $expectedEventTypes
     * @return bool
     * @phpstan-assert-if-true Subscription $existingSubscription
     */
    protected function shouldUpdateExistingSubscription(?Subscription $existingSubscription, array $expectedEventTypes) : bool
    {
        // quickly bail if we don't have a current subscription
        if (empty($existingSubscription)) {
            return false;
        }

        $actualEventTypes = $existingSubscription->eventTypes;

        // sort the arrays so we can compare them (order isn't important here)
        sort($expectedEventTypes);
        sort($actualEventTypes);

        // if the two arrays do not match then we have to update the subscription!
        return $expectedEventTypes !== $actualEventTypes;
    }

    /**
     * Schedules a background job to update the webhook subscription for the current context.
     *
     * @param Subscription $subscription
     * @return void
     * @throws InvalidScheduleException
     */
    protected function scheduleJobToUpdateSubscription(Subscription $subscription) : void
    {
        $job = Schedule::singleAction()
            ->setName(UpdateWebhookSubscriptionJobInterceptor::JOB_NAME)
            ->setArguments($subscription->id)
            ->setScheduleAt(new DateTime('now'));

        if (! $job->isScheduled()) {
            $job->schedule();
        }
    }
}
