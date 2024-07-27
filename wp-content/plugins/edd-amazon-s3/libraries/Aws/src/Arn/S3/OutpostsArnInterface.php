<?php
namespace EDDAmazon\Vendor\Aws\Arn\S3;

use EDDAmazon\Vendor\Aws\Arn\ArnInterface;

/**
 * @internal
 */
interface OutpostsArnInterface extends ArnInterface
{
    public function getOutpostId();
}
