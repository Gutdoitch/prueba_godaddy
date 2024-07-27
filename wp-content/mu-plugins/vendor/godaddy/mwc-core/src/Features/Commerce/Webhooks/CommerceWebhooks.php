<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks;

use GoDaddy\WordPress\MWC\Common\Components\Exceptions\ComponentClassesNotDefinedException;
use GoDaddy\WordPress\MWC\Common\Components\Exceptions\ComponentLoadFailedException;
use GoDaddy\WordPress\MWC\Common\Components\Traits\HasComponentsFromContainerTrait;
use GoDaddy\WordPress\MWC\Common\Features\AbstractFeature;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Traits\IntegrationEnabledOnTestTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Actions\CreateCommerceWebhookSubscriptionsTableAction;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\CreateWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\DeleteWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\UpdateWebhookSubscriptionJobInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Interceptors\WebhookSubscriptionsInterceptor;

class CommerceWebhooks extends AbstractFeature
{
    use HasComponentsFromContainerTrait;
    use IntegrationEnabledOnTestTrait;

    /** @var class-string[] alphabetically ordered list of components to load */
    protected array $componentClasses = [
        CreateCommerceWebhookSubscriptionsTableAction::class,
        CreateWebhookSubscriptionJobInterceptor::class,
        DeleteWebhookSubscriptionJobInterceptor::class,
        UpdateWebhookSubscriptionJobInterceptor::class,
        WebhookSubscriptionsInterceptor::class,
    ];

    /**
     * {@inheritDoc}
     */
    public static function getName() : string
    {
        return 'commerce_webhooks';
    }

    /**
     * Loads the feature.
     *
     * @return void
     * @throws ComponentClassesNotDefinedException|ComponentLoadFailedException
     */
    public function load() : void
    {
        $this->loadComponents();
    }
}
