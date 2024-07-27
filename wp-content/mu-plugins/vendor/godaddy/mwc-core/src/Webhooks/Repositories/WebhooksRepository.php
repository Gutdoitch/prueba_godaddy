<?php

namespace GoDaddy\WordPress\MWC\Core\Webhooks\Repositories;

use DateTime;
use GoDaddy\WordPress\MWC\Common\Exceptions\WordPressDatabaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPress\DatabaseRepository;
use GoDaddy\WordPress\MWC\Core\Webhooks\Actions\CreateWebhooksTableAction;
use GoDaddy\WordPress\MWC\Core\Webhooks\DataObjects\Webhook;
use GoDaddy\WordPress\MWC\Core\Webhooks\Exceptions\InvalidWebhookRowIdException;

/**
 * Webhooks repository.
 */
class WebhooksRepository
{
    /**
     * Gets a webhook record.
     *
     * @param int $webhookRowId
     * @return Webhook|null
     */
    public function getWebhook(int $webhookRowId) : ?Webhook
    {
        $tableName = CreateWebhooksTableAction::getTableName();

        $row = DatabaseRepository::getRow(
            "SELECT * FROM {$tableName} WHERE id = %d",
            [$webhookRowId]
        );

        if (! $row) {
            return null;
        }

        return $this->adaptWebhook($row);
    }

    /**
     * Get a webhook record by webhook ID.
     *
     * @param string $webhookId
     * @return Webhook|null
     */
    public function getWebhookByWebhookId(string $webhookId) : ?Webhook
    {
        $tableName = CreateWebhooksTableAction::getTableName();

        $row = DatabaseRepository::getRow(
            "SELECT * FROM {$tableName} WHERE webhook_id = %s LIMIT 1",
            [$webhookId]
        );

        if (! $row) {
            return null;
        }

        return $this->adaptWebhook($row);
    }

    /**
     * Adds a webhook record.
     *
     * @param Webhook $webhook
     * @return int
     * @throws WordPressDatabaseException
     */
    public function addWebhook(Webhook $webhook) : int
    {
        return DatabaseRepository::insert(
            CreateWebhooksTableAction::getTableName(),
            [
                'namespace'    => $webhook->namespace,
                'webhook_id'   => $webhook->webhookId,
                'payload'      => $webhook->payload,
                'status'       => $webhook->status,
                'result'       => $webhook->result,
                'received_at'  => $webhook->receivedAt,
                'processed_at' => $webhook->processedAt,
            ]
        );
    }

    /**
     * Updates the processed_at field for a webhook.
     *
     * @param int $webhookRowId
     * @param string $status
     * @param string|null $result
     * @param string|null $processedAt If null, the current datetime is used.
     * @return void
     * @throws InvalidWebhookRowIdException
     * @throws WordPressDatabaseException
     */
    public function updateProcessedStatus(int $webhookRowId, string $status = '', ?string $result = null, ?string $processedAt = null)
    {
        $row = $this->getWebhook($webhookRowId);

        if (! $row) {
            throw new InvalidWebhookRowIdException();
        }

        $processedAt = $processedAt ?? (new DateTime())->format('Y-m-d\TH:i:s\Z');

        DatabaseRepository::update(
            CreateWebhooksTableAction::getTableName(),
            [
                'status'       => $status,
                'result'       => $result,
                'processed_at' => $processedAt,
            ],
            [
                'id' => $webhookRowId,
            ]
        );
    }

    /**
     * Adapts a database row to a Webhook object.
     *
     * @param array<string, mixed> $row
     * @return Webhook
     */
    public function adaptWebhook(array $row) : Webhook
    {
        return Webhook::getNewInstance([
            'id'          => ArrayHelper::getIntValueForKey($row, 'id'),
            'namespace'   => ArrayHelper::getStringValueForKey($row, 'namespace'),
            'webhookId'   => ArrayHelper::getStringValueForKey($row, 'webhook_id'),
            'payload'     => ArrayHelper::getStringValueForKey($row, 'payload'),
            'status'      => ArrayHelper::getStringValueForKey($row, 'status'),
            'result'      => TypeHelper::stringOrNull(ArrayHelper::get($row, 'result')),
            'receivedAt'  => TypeHelper::stringOrNull(ArrayHelper::get($row, 'received_at')),
            'processedAt' => TypeHelper::stringOrNull(ArrayHelper::get($row, 'processed_at')),
        ]);
    }
}
