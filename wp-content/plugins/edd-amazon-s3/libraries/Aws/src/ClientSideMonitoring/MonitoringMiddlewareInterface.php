<?php

namespace EDDAmazon\Vendor\Aws\ClientSideMonitoring;

use EDDAmazon\Vendor\Aws\CommandInterface;
use EDDAmazon\Vendor\Aws\Exception\AwsException;
use EDDAmazon\Vendor\Aws\ResultInterface;
use EDDAmazon\Vendor\GuzzleHttp\Psr7\Request;
use EDDAmazon\Vendor\Psr\Http\Message\RequestInterface;

/**
 * @internal
 */
interface MonitoringMiddlewareInterface
{

    /**
     * Data for event properties to be sent to the monitoring agent.
     *
     * @param RequestInterface $request
     * @return array
     */
    public static function getRequestData(RequestInterface $request);


    /**
     * Data for event properties to be sent to the monitoring agent.
     *
     * @param ResultInterface|AwsException|\Exception $klass
     * @return array
     */
    public static function getResponseData($klass);

    public function __invoke(CommandInterface $cmd, RequestInterface $request);
}