<?php
namespace EDDAmazon\Vendor\Aws\Api\Parser;

use EDDAmazon\Vendor\Aws\Api\StructureShape;
use EDDAmazon\Vendor\Aws\Api\Service;
use EDDAmazon\Vendor\Aws\Result;
use EDDAmazon\Vendor\Aws\CommandInterface;
use EDDAmazon\Vendor\Psr\Http\Message\ResponseInterface;
use EDDAmazon\Vendor\Psr\Http\Message\StreamInterface;

/**
 * @internal Implements JSON-RPC parsing (e.g., DynamoDB)
 */
class JsonRpcParser extends AbstractParser
{
    use PayloadParserTrait;

    /**
     * @param Service    $api    Service description
     * @param JsonParser $parser JSON body builder
     */
    public function __construct(Service $api, JsonParser $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new JsonParser();
    }

    public function __invoke(
        CommandInterface $command,
        ResponseInterface $response
    ) {
        $operation = $this->api->getOperation($command->getName());
        $result = null === $operation['output']
            ? null
            : $this->parseMemberFromStream(
                $response->getBody(),
                $operation->getOutput(),
                $response
            );

        return new Result($result ?: []);
    }

    public function parseMemberFromStream(
        StreamInterface $stream,
        StructureShape $member,
        $response
    ) {
        return $this->parser->parse($member, $this->parseJson($stream, $response));
    }
}
