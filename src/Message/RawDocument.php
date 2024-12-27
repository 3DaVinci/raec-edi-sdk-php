<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message;

use RaecEdiSDK\Exception\InvalidJsonStringException;

class RawDocument implements MessageInterface
{
    public readonly string $rawJson;

    /**
     * @param string $rawJson
     * @throws InvalidJsonStringException
     */
    public function __construct(string $rawJson)
    {
        if (!json_validate($rawJson)) {
            throw new InvalidJsonStringException();
        }

        $this->rawJson = $rawJson;
    }

    public function jsonSerialize(): array
    {
        return json_decode($this->rawJson, true);
    }

    public function isTest(): bool
    {
        $data = $this->jsonSerialize();

        return isset($data['isTest']) && $data['isTest'] == true;
    }
}
