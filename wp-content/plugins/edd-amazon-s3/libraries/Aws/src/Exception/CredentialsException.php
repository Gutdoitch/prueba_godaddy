<?php
namespace EDDAmazon\Vendor\Aws\Exception;

use EDDAmazon\Vendor\Aws\HasMonitoringEventsTrait;
use EDDAmazon\Vendor\Aws\MonitoringEventsInterface;

class CredentialsException extends \RuntimeException implements
    MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
