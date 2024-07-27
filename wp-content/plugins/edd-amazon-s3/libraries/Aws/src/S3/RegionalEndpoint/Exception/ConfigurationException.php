<?php
namespace EDDAmazon\Vendor\Aws\S3\RegionalEndpoint\Exception;

use EDDAmazon\Vendor\Aws\HasMonitoringEventsTrait;
use EDDAmazon\Vendor\Aws\MonitoringEventsInterface;

/**
 * Represents an error interacting with configuration for sts regional endpoints
 */
class ConfigurationException extends \RuntimeException implements
    MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
