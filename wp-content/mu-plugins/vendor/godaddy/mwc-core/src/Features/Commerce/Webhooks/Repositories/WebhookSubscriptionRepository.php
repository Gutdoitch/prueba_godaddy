<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Repositories;

use GoDaddy\WordPress\MWC\Common\Exceptions\WordPressDatabaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPress\DatabaseRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Enums\CommerceTableColumns;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Enums\CommerceTables;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\Context;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Repositories\CommerceContextRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Actions\CreateCommerceWebhookSubscriptionsTableAction;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Cache\WebhookSubscriptionCache;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Providers\DataObjects\Subscription;
use InvalidArgumentException;

class WebhookSubscriptionRepository
{
    /**
     * Creates a new subscription entry for the given object.
     *
     * @param Subscription $subscription
     * @return int
     * @throws WordPressDatabaseException|InvalidArgumentException
     */
    public function createSubscription(Subscription $subscription) : int
    {
        if (! $subscription->secret) {
            throw new InvalidArgumentException('You cannot save a subscription without its secret.');
        }

        $contextId = CommerceContextRepository::getInstance()->findOrCreateContextWithCache($subscription->context->storeId);

        /*
         * Clear the cache for this context ID.
         *
         * It's possible for the cache to in a state where it contains an empty subscription (due to previous failures).
         * This will ensure that the cache is cleared and the next request will fetch the correct data.
         */
        WebhookSubscriptionCache::getInstance((string) $contextId)->clear();

        return DatabaseRepository::insert(
            CreateCommerceWebhookSubscriptionsTableAction::getTableName(),
            [
                CommerceTableColumns::CommerceContextId => $contextId,
                CommerceTableColumns::SubscriptionId    => $subscription->id,
                CommerceTableColumns::Name              => $subscription->name,
                CommerceTableColumns::Description       => $subscription->description,
                CommerceTableColumns::EventTypes        => json_encode($subscription->eventTypes),
                CommerceTableColumns::DeliveryUrl       => $subscription->deliveryUrl,
                CommerceTableColumns::IsEnabled         => $subscription->isEnabled ? 1 : 0,
                CommerceTableColumns::Secret            => $subscription->secret,
                CommerceTableColumns::CreatedAt         => $subscription->createdAt,
                CommerceTableColumns::UpdatedAt         => $subscription->updatedAt,
            ]
        );
    }

    /**
     * Gets a subscription row by context ID.
     *
     * @param int $contextId
     * @return Subscription|null
     */
    public function getSubscriptionByContextId(int $contextId) : ?Subscription
    {
        $tableName = CreateCommerceWebhookSubscriptionsTableAction::getTableName();
        $contextTable = CommerceTables::Contexts;

        $query = 'SELECT '.$tableName.'.*, '.$contextTable.'.'.CommerceTableColumns::GdStoreId.'
                     FROM '.$tableName.'
                         INNER JOIN '.$contextTable.' ON '.$tableName.'.'.CommerceTableColumns::CommerceContextId.' = '.$contextTable.'.id
                     WHERE '.CommerceTableColumns::CommerceContextId.' = %d';

        $row = DatabaseRepository::getRow(
            $query,
            [$contextId]
        );

        if (! $row) {
            return null;
        }

        return Subscription::getNewInstance([
            'id'          => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::SubscriptionId),
            'name'        => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::Name),
            'description' => ArrayHelper::get($row, CommerceTableColumns::Description),
            'context'     => Context::getNewInstance(['storeId' => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::GdStoreId)]),
            'eventTypes'  => TypeHelper::array(json_decode(ArrayHelper::getStringValueForKey($row, CommerceTableColumns::EventTypes), true), []),
            'deliveryUrl' => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::DeliveryUrl),
            'isEnabled'   => ArrayHelper::getIntValueForKey($row, CommerceTableColumns::IsEnabled) === 1,
            'secret'      => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::Secret),
            'createdAt'   => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::CreatedAt),
            'updatedAt'   => ArrayHelper::getStringValueForKey($row, CommerceTableColumns::UpdatedAt),
        ]);
    }

    /**
     * Deletes a subscription by its remote UUID.
     *
     * @param string $subscriptionId
     * @return void
     * @throws WordPressDatabaseException
     */
    public function deleteSubscription(string $subscriptionId) : void
    {
        DatabaseRepository::delete(
            CreateCommerceWebhookSubscriptionsTableAction::getTableName(),
            [CommerceTableColumns::SubscriptionId => $subscriptionId],
            ['%s']
        );
    }
}
