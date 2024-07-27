<?php
namespace EDDAmazon\Vendor\Aws\Signature;

use EDDAmazon\Vendor\Aws\Credentials\CredentialsInterface;
use EDDAmazon\Vendor\Psr\Http\Message\RequestInterface;

/**
 * Provides anonymous client access (does not sign requests).
 */
class AnonymousSignature implements SignatureInterface
{
    /**
     * /** {@inheritdoc}
     */
    public function signRequest(
        RequestInterface $request,
        CredentialsInterface $credentials
    ) {
        return $request;
    }

    /**
     * /** {@inheritdoc}
     */
    public function presign(
        RequestInterface $request,
        CredentialsInterface $credentials,
        $expires,
        array $options = []
    ) {
        return $request;
    }
}
