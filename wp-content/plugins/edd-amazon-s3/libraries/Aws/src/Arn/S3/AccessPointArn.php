<?php
namespace EDDAmazon\Vendor\Aws\Arn\S3;

use EDDAmazon\Vendor\Aws\Arn\AccessPointArn as BaseAccessPointArn;
use EDDAmazon\Vendor\Aws\Arn\AccessPointArnInterface;
use EDDAmazon\Vendor\Aws\Arn\ArnInterface;
use EDDAmazon\Vendor\Aws\Arn\Exception\InvalidArnException;

/**
 * @internal
 */
class AccessPointArn extends BaseAccessPointArn implements AccessPointArnInterface
{
    /**
     * Validation specific to AccessPointArn
     *
     * @param array $data
     */
    public static function validate(array $data)
    {
        parent::validate($data);
        if ($data['service'] !== 's3') {
            throw new InvalidArnException("The 3rd component of an S3 access"
                . " point ARN represents the region and must be 's3'.");
        }
    }
}