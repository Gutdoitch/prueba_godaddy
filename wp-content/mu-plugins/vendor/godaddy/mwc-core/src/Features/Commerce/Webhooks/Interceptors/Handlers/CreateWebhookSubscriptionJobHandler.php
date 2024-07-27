<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\Handlers;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\Contracts\CommerceExceptionContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Configuration\Contracts\CommerceWebhooksRuntimeConfigurationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\CreateWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Services\Contracts\SubscriptionServiceContract;
use GoDaddy\WordPress\MWC\Core\Interceptors\Handlers\AbstractInterceptorHandler;

/**
 * Handle creating commerce webhook subscriptions.
 * {@see CreateWebhookSubscriptionJobInterceptor}.
 */
class CreateWebhookSubscriptionJobHandler extends AbstractInterceptorHandler
{
    protected SubscriptionServiceContract $subscriptionService;
    protected CommerceWebhooksRuntimeConfigurationContract $runtimeConfiguration;

    public function __construct(SubscriptionServiceContract $subscriptionService, CommerceWebhooksRuntimeConfigurationContract $runtimeConfiguration)
    {
        $this->subscriptionService = $subscriptionService;
        $this->runtimeConfiguration = $runtimeConfiguration;
    }

    /**
     * {@inheritDoc}
     */
    public function run(...$args)
    {
        $eventTypes = $this->runtimeConfiguration->getEnabledWebhookEventTypeNames();

        if (! $eventTypes) {
            return;
        }

        try {
            // Create a new webhook subscription based on the current configuration.
            $operation = $this->subscriptionService->getCreateWebhookSubscriptionOperation($eventTypes);

            $this->subscriptionService->createSubscription($operation);
        } catch (CommerceExceptionContract|Exception $e) {
            SentryException::getNewInstance('Failed to create Commerce webhook subscription: '.$e->getMessage(), $e);
        }
    }
}
