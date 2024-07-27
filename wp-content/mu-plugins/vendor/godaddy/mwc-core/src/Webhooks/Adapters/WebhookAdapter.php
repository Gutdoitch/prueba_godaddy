<?php

namespace GoDaddy\WordPress\MWC\Core\Webhooks\Adapters;

use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\AdapterException;
use GoDaddy\WordPress\MWC\Common\Helpers\StringHelper;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Webhooks\DataObjects\IncomingWebhookRequest;
use GoDaddy\WordPress\MWC\Core\Webhooks\DataObjects\Webhook;
use GoDaddy\WordPress\MWC\Core\Webhooks\Enums\WebhookStatuses;

class WebhookAdapter implements DataSourceAdapterContract
{
    use CanGetNewInstanceTrait;

    /**
     * Converts an incoming webhook request object into a Webhook DTO for database storage.
     *
     * @param IncomingWebhookRequest|null $request
     * @param string|null $namespace
     * @return Webhook
     * @throws AdapterException
     */
    public function convertFromSource(?IncomingWebhookRequest $request = null, ?string $namespace = null) : Webhook
    {
        if (! $request || ! $namespace) {
            throw new AdapterException('Missing required request or namespace.');
        }

        return new Webhook([
            'namespace'   => $namespace,
            'webhookId'   => $this->getOrGenerateWebhookId($request),
            'payload'     => $request->getBody() ?: '',
            'status'      => WebhookStatuses::Queued,
            'result'      => null,
            'receivedAt'  => date('Y-m-d H:i:s'),
            'processedAt' => null,
        ]);
    }

    /**
     * Gets the webhook identifier from the request. If none is set, then a UUID is generated.
     *
     * @param IncomingWebhookRequest $request
     * @return string
     */
    protected function getOrGenerateWebhookId(IncomingWebhookRequest $request) : string
    {
        if ($webhookId = $request->getWebhookId()) {
            return $webhookId;
        }

        // otherwise we need to generate one
        return StringHelper::generateUuid4();
    }

    public function convertToSource()
    {
        // no-op
    }
}
