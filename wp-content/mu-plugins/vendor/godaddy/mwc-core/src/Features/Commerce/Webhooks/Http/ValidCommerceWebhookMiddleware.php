<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Http;

use Closure;
use Exception;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\ValidationHelper;
use GoDaddy\WordPress\MWC\Common\Http\IncomingRequest;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\Contracts\CommerceContextContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Repositories\WebhookSubscriptionRepository;
use GoDaddy\WordPress\MWC\Core\Webhooks\DataObjects\IncomingWebhookRequest;
use GoDaddy\WordPress\MWC\Core\Webhooks\Middleware\Contracts\WebhookMiddlewareContract;

/**
 * Validates an incoming Commerce webhook.
 */
class ValidCommerceWebhookMiddleware implements WebhookMiddlewareContract
{
    protected CommerceContextContract $commerceContext;

    protected WebhookSubscriptionRepository $webhookSubscriptionRepository;

    public function __construct(CommerceContextContract $commerceContext, WebhookSubscriptionRepository $webhookSubscriptionRepository)
    {
        $this->commerceContext = $commerceContext;
        $this->webhookSubscriptionRepository = $webhookSubscriptionRepository;
    }

    /**
     * Handles a webhook request.
     *
     * This ensures that the request is a valid webhook.
     *
     * @param IncomingWebhookRequest $request
     * @param Closure $next
     * @return IncomingWebhookRequest
     * @throws Exception
     */
    public function handle(IncomingRequest $request, Closure $next) : IncomingRequest
    {
        if (! $secret = $this->getWebhookSecretForCurrentStore()) {
            throw new Exception('Unable to validate webhook. Webhook subscription secret is missing.', 500);
        }

        if (! ValidationHelper::isValidWebhook(TypeHelper::string($secret, ''), TypeHelper::string($request->getBody(), ''), $request->getHeaders())) {
            throw new Exception('Invalid webhook signature.', 422);
        }

        return $next($request);
    }

    /**
     * Gets the webhook secret for the current store.
     *
     * @return string|null
     */
    protected function getWebhookSecretForCurrentStore() : ?string
    {
        if (! $contextId = $this->commerceContext->getId()) {
            return null;
        }

        if (! $subscription = $this->webhookSubscriptionRepository->getSubscriptionByContextId($contextId)) {
            return null;
        }

        return $subscription->secret;
    }
}
