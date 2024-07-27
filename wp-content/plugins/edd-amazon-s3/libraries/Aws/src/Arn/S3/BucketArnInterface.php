<?php
namespace EDDAmazon\Vendor\Aws\Arn\S3;

use EDDAmazon\Vendor\Aws\Arn\ArnInterface;

/**
 * @internal
 */
interface BucketArnInterface extends ArnInterface
{
    public function getBucketName();
}
