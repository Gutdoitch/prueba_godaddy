<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Webhooks\Providers\GoDaddy\Http;

use Exception;
use GoDaddy\WordPress\MWC\Common\Auth\Contracts\AuthMethodContract;
use GoDaddy\WordPress\MWC\Common\Auth\Methods\TokenAuthMethod;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\Http\Requests\AbstractRequest;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\Http\Traits\IsCommerceRequestTrait;
use GoDaddy\WordPress\MWC\Core\Traits\CanGetEnvironmentBasedConfigValueTrait;

class Request extends AbstractRequest
{
    use CanGetEnvironmentBasedConfigValueTrait;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();

        $timeout = $this->getEnvironmentConfigValue('commerce.webhooks.subscriptionApi.timeout');

        $this->setTimeout(TypeHelper::int($timeout, 10));
    }

    /**
     * {@inheritDoc}
     */
    protected function getBaseUrl() : string
    {
        return TypeHelper::string($this->getEnvironmentConfigValue('commerce.webhooks.subscriptionApi.url'), '');
    }

    /**
     * This is not meant to proxy through MWC API, so wiping this out is necessary for the PoC to work.
     * Once all requests are moved to 3-legged oauth we will adjust {@see IsCommerceRequestTrait} accordingly.
     *
     * @return string
     */
    protected function getPathPrefix() : string
    {
        return '';
    }

    /**
     * @todo replace this entire method once we add 3-legged oauth. This is a temporary placeholder method for the PoC.
     *
     * @return string
     */
    protected function getToken() : string
    {
        return defined('COMMERCE_WEBHOOK_TOKEN') ? COMMERCE_WEBHOOK_TOKEN : '';
    }

    /**
     * @TODO replace this entire method once we add 3-legged oauth. This is a temporary placeholder method for the PoC.
     *
     * @return AuthMethodContract
     */
    protected function getAuthMethodFromAuthProvider() : AuthMethodContract
    {
        return (new TokenAuthMethod())
            ->setToken($this->getToken())
            ->setType('Bearer');
    }
}
