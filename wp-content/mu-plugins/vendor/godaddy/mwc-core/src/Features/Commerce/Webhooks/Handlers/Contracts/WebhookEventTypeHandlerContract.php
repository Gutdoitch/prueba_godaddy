<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Handlers\Contracts;

/**
 * Describes classes that can handle a single webhook event type.
 */
interface WebhookEventTypeHandlerContract
{
    /**
     * Handles the webhook.
     *
     * @param array<string, mixed> $data
     * @return void
     */
    public function handle(array $data) : void;
}
