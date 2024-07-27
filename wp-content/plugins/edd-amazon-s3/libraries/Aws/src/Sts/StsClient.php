<?php
namespace EDDAmazon\Vendor\Aws\Sts;

use EDDAmazon\Vendor\Aws\AwsClient;
use EDDAmazon\Vendor\Aws\CacheInterface;
use EDDAmazon\Vendor\Aws\Credentials\Credentials;
use EDDAmazon\Vendor\Aws\Result;
use EDDAmazon\Vendor\Aws\Sts\RegionalEndpoints\ConfigurationProvider;

/**
 * This client is used to interact with the **AWS Security Token Service (AWS STS)**.
 *
 * @method \EDDAmazon\Vendor\Aws\Result assumeRole(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise assumeRoleAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result assumeRoleWithSAML(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise assumeRoleWithSAMLAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result assumeRoleWithWebIdentity(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise assumeRoleWithWebIdentityAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result decodeAuthorizationMessage(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise decodeAuthorizationMessageAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result getAccessKeyInfo(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise getAccessKeyInfoAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result getCallerIdentity(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise getCallerIdentityAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result getFederationToken(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise getFederationTokenAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result getSessionToken(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise getSessionTokenAsync(array $args = [])
 */
class StsClient extends AwsClient
{

    /**
     * {@inheritdoc}
     *
     * In addition to the options available to
     * {@see \EDDAmazon\Vendor\Aws\AwsClient::__construct}, StsClient accepts the following
     * options:
     *
     * - sts_regional_endpoints:
     *   (EDDAmazon\Vendor\Aws\Sts\RegionalEndpoints\ConfigurationInterface|EDDAmazon\Vendor\Aws\CacheInterface\|callable|string|array)
     *   Specifies whether to use regional or legacy endpoints for legacy regions.
     *   Provide an EDDAmazon\Vendor\Aws\Sts\RegionalEndpoints\ConfigurationInterface object, an
     *   instance of EDDAmazon\Vendor\Aws\CacheInterface, a callable configuration provider used
     *   to create endpoint configuration, a string value of `legacy` or
     *   `regional`, or an associative array with the following keys:
     *   endpoint_types (string)  Set to `legacy` or `regional`, defaults to
     *   `legacy`
     *
     * @param array $args
     */
    public function __construct(array $args)
    {
        if (
            !isset($args['sts_regional_endpoints'])
            || $args['sts_regional_endpoints'] instanceof CacheInterface
        ) {
            $args['sts_regional_endpoints'] = ConfigurationProvider::defaultProvider($args);
        }
        $this->addBuiltIns($args);
        parent::__construct($args);
    }

    /**
     * Creates credentials from the result of an STS operations
     *
     * @param Result $result Result of an STS operation
     *
     * @return Credentials
     * @throws \InvalidArgumentException if the result contains no credentials
     */
    public function createCredentials(Result $result)
    {
        if (!$result->hasKey('Credentials')) {
            throw new \InvalidArgumentException('Result contains no credentials');
        }

        $c = $result['Credentials'];

        return new Credentials(
            $c['AccessKeyId'],
            $c['SecretAccessKey'],
            isset($c['SessionToken']) ? $c['SessionToken'] : null,
            isset($c['Expiration']) && $c['Expiration'] instanceof \DateTimeInterface
                ? (int) $c['Expiration']->format('U')
                : null
        );
    }

    /**
     * Adds service-specific client built-in value
     *
     * @return void
     */
    private function addBuiltIns($args)
    {
        $key = 'AWS::STS::UseGlobalEndpoint';
        $result = $args['sts_regional_endpoints'] instanceof \Closure ?
            $args['sts_regional_endpoints']()->wait() : $args['sts_regional_endpoints'];

        if (is_string($result)) {
            if ($result === 'regional') {
                $value = false;
            } else if ($result === 'legacy') {
                $value = true;
            } else {
                return;
            }
        } else {
            if ($result->getEndpointsType() === 'regional') {
                $value = false;
            } else {
                $value = true;
            }
        }

        $this->clientBuiltIns[$key] = $value;
    }
}
