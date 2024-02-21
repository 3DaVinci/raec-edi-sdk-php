<?php

namespace RaecEdiSDK\Message;

trait ObjectSerializeTrait
{
    /**
     * @return array<string, mixed>
     */
    protected function objectToArray(): array
    {
        return array_filter(
            get_object_vars($this),
            fn($value, $key) => !is_null($value) && !is_object($value),
            ARRAY_FILTER_USE_BOTH
        );
    }
}
