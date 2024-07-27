<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Webhooks\Handlers;

use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Helpers\RemoteProductNotFoundHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Repositories\ProductMapRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Exceptions\WebhookProcessingException;

class ProductDeletedWebhookHandler extends AbstractProductWebhookHandler
{
    protected ProductMapRepository $productMapRepository;

    protected RemoteProductNotFoundHelper $remoteProductNotFoundHelper;

    public function __construct(ProductMapRepository $productMapRepository, RemoteProductNotFoundHelper $remoteProductNotFoundHelper)
    {
        $this->productMapRepository = $productMapRepository;
        $this->remoteProductNotFoundHelper = $remoteProductNotFoundHelper;
    }

    /**
     * Handles `commerce.product.deleted` events by also deleting the corresponding local product.
     *
     * @param array<string, mixed> $data
     * @return void
     * @throws WebhookProcessingException
     */
    public function handle(array $data) : void
    {
        if (! $remoteProductId = TypeHelper::string(ArrayHelper::get($data, 'data.productId', []), '')) {
            throw new WebhookProcessingException('Product ID not found in webhook data.');
        }

        if (! $localId = $this->productMapRepository->getLocalId($remoteProductId)) {
            throw new WebhookProcessingException('Local product ID not found for remote product ID: '.$remoteProductId);
        }

        $this->remoteProductNotFoundHelper->handle($localId);
    }
}
