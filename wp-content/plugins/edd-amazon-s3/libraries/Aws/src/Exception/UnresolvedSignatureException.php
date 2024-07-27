<?php
namespace EDDAmazon\Vendor\Aws\Exception;

use EDDAmazon\Vendor\Aws\HasMonitoringEventsTrait;
use EDDAmazon\Vendor\Aws\MonitoringEventsInterface;

class UnresolvedSignatureException extends \RuntimeException implements
    MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
