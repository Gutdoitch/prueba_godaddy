<?php
namespace EDDAmazon\Vendor\Aws\SSO;

use EDDAmazon\Vendor\Aws\AwsClient;

/**
 * This client is used to interact with the **AWS Single Sign-On** service.
 * @method \EDDAmazon\Vendor\Aws\Result getRoleCredentials(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise getRoleCredentialsAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result listAccountRoles(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise listAccountRolesAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result listAccounts(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise listAccountsAsync(array $args = [])
 * @method \EDDAmazon\Vendor\Aws\Result logout(array $args = [])
 * @method \EDDAmazon\Vendor\GuzzleHttp\Promise\Promise logoutAsync(array $args = [])
 */
class SSOClient extends AwsClient {}
