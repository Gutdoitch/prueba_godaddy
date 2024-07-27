<?php
namespace EDDAmazon\Vendor\Aws\Api\Parser;

use EDDAmazon\Vendor\Aws\Api\Service;
use EDDAmazon\Vendor\Aws\Api\StructureShape;
use EDDAmazon\Vendor\Aws\CommandInterface;
use EDDAmazon\Vendor\Aws\ResultInterface;
use EDDAmazon\Vendor\Psr\Http\Message\ResponseInterface;
use EDDAmazon\Vendor\Psr\Http\Message\StreamInterface;

/**
 * @internal
 */
abstract class AbstractParser
{
    /** @var \EDDAmazon\Vendor\Aws\Api\Service Representation of the service API*/
    protected $api;

    /** @var callable */
    protected $parser;

    /**
     * @param Service $api Service description.
     */
    public function __construct(Service $api)
    {
        $this->api = $api;
    }

    /**
     * @param CommandInterface  $command  Command that was executed.
     * @param ResponseInterface $response Response that was received.
     *
     * @return ResultInterface
     */
    abstract public function __invoke(
        CommandInterface $command,
        ResponseInterface $response
    );

    abstract public function parseMemberFromStream(
        StreamInterface $stream,
        StructureShape $member,
        $response
    );
}
