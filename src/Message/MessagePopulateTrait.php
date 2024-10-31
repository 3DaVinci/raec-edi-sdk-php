<?php

namespace RaecEdiSDK\Message;

use RaecEdiSDK\Exception\InvalidBooleanValueException;
use RaecEdiSDK\Exception\InvalidStringValueException;

trait MessagePopulateTrait
{
    /**
     * @param string[] $boolProperties
     * @param string|bool|int[] $data
     * @param bool $isItem
     * @return void
     */
    protected function setBooleanProperties(array $boolProperties, array $data, bool $isItem = false): void
    {
        foreach ($boolProperties as $property) {
            if (!isset($data[$property]) || $data[$property] === '') {
                continue;
            }

            if (!in_array($data[$property], MessageInterface::ALLOW_BOOLEAN_VALUES, true)) {
                $propertyPrefix = $isItem ? 'item.' : '';
                throw new InvalidBooleanValueException($propertyPrefix.$property, (string) $data[$property]);
            }

            if ($data[$property] === 'false') {
                $data[$property] = false;
            }

            $this->$property = (bool) $data[$property];
        }
    }

    protected function setStringProperties(array $stringProperties, array $data, bool $isItem = false): void
    {
        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && $data[$property]) {
                if (!is_scalar($data[$property])) {
                    $propertyPrefix = $isItem ? 'item.' : '';
                    throw new InvalidStringValueException($propertyPrefix.$property, gettype($data[$property]));
                }
                $this->$property = (string) $data[$property];
            }
        }
    }
}
