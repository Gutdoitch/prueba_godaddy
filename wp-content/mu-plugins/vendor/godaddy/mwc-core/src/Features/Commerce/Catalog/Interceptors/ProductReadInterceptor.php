<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\CatalogIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers\ProductReadHandler;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers\ProductVariationReadHandler;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Traits\CanLoadWhenReadsEnabledTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Commerce;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Enums\CustomWordPressCoreHook;
use WP_Post;
use WP_Query;

/**
 * Interceptor for reading product post objects from catalog.
 */
class ProductReadInterceptor extends AbstractInterceptor
{
    use CanLoadWhenReadsEnabledTrait;

    protected ProductReadHandler $productReadHandler;
    protected ProductVariationReadHandler $productVariationReadHandler;

    /**
     * We inject the handlers into the interceptor so that we only load them once. This is because our post filters
     * run very frequently and we don't want to have to re-resolve the handlers and their dependencies every time.
     *
     * @param ProductReadHandler $productReadHandler
     * @param ProductVariationReadHandler $productVariationReadHandler
     */
    public function __construct(ProductReadHandler $productReadHandler, ProductVariationReadHandler $productVariationReadHandler)
    {
        $this->productReadHandler = $productReadHandler;
        $this->productVariationReadHandler = $productVariationReadHandler;
    }

    /**
     * Adds hooks.
     *
     * @return void
     * @throws Exception
     */
    public function addHooks() : void
    {
        /* @see wp_insert_post() */
        Register::action()
            ->setGroup(CustomWordPressCoreHook::WpInsertPost_BeforeGetPostInstance)
            ->setHandler([$this, 'disableReads'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        /* @see wp_insert_post() */
        Register::action()
            ->setGroup(CustomWordPressCoreHook::WpInsertPost_AfterGetPostInstance)
            ->setHandler([$this, 'enableReads'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        /* @see WP_Post::get_instance() */
        Register::filter()
            ->setGroup(CustomWordPressCoreHook::WpPost_GetInstance)
            ->setHandler([$this, 'handleProductRead'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        /* @see WP_Query::get_posts() */
        $this->productVariationReadHandler->getActionHook()->execute();
    }

    /**
     * Enables reads from catalog.
     *
     * @return void
     */
    public function enableReads() : void
    {
        CatalogIntegration::enableCapability(Commerce::CAPABILITY_READ);
    }

    /**
     * Disables reads from catalog.
     *
     * @return void
     */
    public function disableReads() : void
    {
        CatalogIntegration::disableCapability(Commerce::CAPABILITY_READ);
    }

    /**
     * @internal
     *
     * @param mixed ...$args
     * @return mixed
     */
    public function handleProductRead(...$args)
    {
        return $this->productReadHandler->run(...$args);
    }
}
