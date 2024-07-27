<?php
namespace EDDAmazon\Vendor\Aws\ClientSideMonitoring\Exception;

use EDDAmazon\Vendor\Aws\HasMonitoringEventsTrait;
use EDDAmazon\Vendor\Aws\MonitoringEventsInterface;


/**
 * Represents an error interacting with configuration for client-side monitoring.
 */
class ConfigurationException extends \RuntimeException implements
    MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
