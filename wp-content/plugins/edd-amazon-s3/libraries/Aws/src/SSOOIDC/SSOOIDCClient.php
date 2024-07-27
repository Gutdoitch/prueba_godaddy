<?php
namespace EDDAmazon\Vendor\Aws\SSOOIDC;

use EDDAmazon\Vendor\Aws\AwsClient;

/**
 * This client is used to interact with the **AWS SSO OIDC** service.
 * @method \EDDAmazon\Vendor\Aws\Result createToken(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise createTokenAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result registerClient(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise registerClientAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result startDeviceAuthorization(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise startDeviceAuthorizationAsync(array $args = [])
 */
class SSOOIDCClient extends AwsClient {}
