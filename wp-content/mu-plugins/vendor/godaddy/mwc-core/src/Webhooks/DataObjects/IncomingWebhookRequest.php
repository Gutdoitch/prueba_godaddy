<?php

namespace GoDaddy\WordPress\MWC\Core\Webhooks\DataObjects;

use GoDaddy\WordPress\MWC\Common\Http\IncomingRequest;

/**
 * Contains raw data from an incoming webhook request.
 */
class IncomingWebhookRequest extends IncomingRequest
{
    /** @var string unique identifier for this webhook */
    protected string $webhookId = '';

    /**
     * Gets the unique identifier for this webhook.
     *
     * @return string
     */
    public function getWebhookId() : string
    {
        return $this->webhookId;
    }

    /**
     * Sets the webhook identifier.
     *
     * @param string $value
     * @return $this
     */
    public function setWebhookId(string $value) : IncomingWebhookRequest
    {
        $this->webhookId = $value;

        return $this;
    }
}
