<?php

declare(strict_types=1);


namespace RaecEdiSDK;

use DateTimeImmutable;
use RaecEdiSDK\Exception\InvalidDateTimeValueException;
use RaecEdiSDK\Exception\InvalidDateValueException;
use RaecEdiSDK\Message\MessageInterface;
use RuntimeException;

class Utils
{
    const DEFAULT_JSON_FLAGS = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION | JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR;

    /**
     * @param string $value
     * @param string $fieldName
     * @return DateTimeImmutable
     * @throws InvalidDateTimeValueException
     */
    public static function stringToDateTime(string $value, string $fieldName): DateTimeImmutable
    {
        $dateTimeValue = DateTimeImmutable::createFromFormat(MessageInterface::DATE_TIME_FORMAT, $value);

        if (!$dateTimeValue) {
            $dateTimeValue = DateTimeImmutable::createFromFormat(MessageInterface::DATE_TIME_FORMAT_EXTRA, $value);
        }

        if (!$dateTimeValue) {
            throw new InvalidDateTimeValueException($fieldName, $value);
        }

        return $dateTimeValue;
    }

    /**
     * @param string $value
     * @param string $fieldName
     * @return DateTimeImmutable
     * @throws InvalidDateValueException
     */
    public static function stringToDate(string $value, string $fieldName): DateTimeImmutable
    {
        $dateValue = DateTimeImmutable::createFromFormat(MessageInterface::DATE_FORMAT, $value);

        if (!$dateValue) {
            $dateValue = DateTimeImmutable::createFromFormat(MessageInterface::DATE_FORMAT_EXTRA, $value);
        }

        if (!$dateValue) {
            throw new InvalidDateValueException($fieldName, $value);
        }

        return $dateValue;
    }

    public static function dateTimeToString(DateTimeImmutable $dateTime): string
    {
        return $dateTime->format(MessageInterface::DATE_TIME_FORMAT);
    }

    public static function dateToString(DateTimeImmutable $dateTime): string
    {
        return $dateTime->format(MessageInterface::DATE_FORMAT);
    }

    public static function jsonEncode(mixed $data, bool $ignoreErrors = false): string
    {
        if ($ignoreErrors) {
            $json = @json_encode($data, self::DEFAULT_JSON_FLAGS);
            if (false === $json) {

                return 'null';
            }

            return $json;
        }

        $json = json_encode($data, self::DEFAULT_JSON_FLAGS);
        if (false === $json) {
            $msg = match (json_last_error()) {
                JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
                JSON_ERROR_STATE_MISMATCH => 'Underflow or the modes mismatch',
                JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
                JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded',
                default => 'Unknown error',
            };

            throw new RuntimeException('JSON encoding failed: '.$msg.'. Encoding: '.var_export($data, true));
        }

        return $json;
    }
}
