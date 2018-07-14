<?php declare(strict_types=1);

namespace Koncept\Kernel\Exceptions;

use RuntimeException;
use stdClass;


/**
 * [Exception] Json Merge Exception
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class JsonMergeException
    extends RuntimeException
{
    /**
     * @param string $key
     * @param string $expectedType
     * @param mixed $actualValue
     * @return JsonMergeException
     */
    public static function FromType(string $key, string $expectedType, $actualValue): self
    {
        $type = self::GetType($actualValue);
        return new self (
            "The type of {$key} in the first JSON is {$expectedType} while that in the second JSON is {$type}"
        );
    }

    /**
     * @param $m
     * @return string
     */
    private static function GetType($m): string
    {
        if ($m instanceof stdClass) return 'object';

        if (is_array($m)) return 'array';

        if (is_int($m) || is_float($m)) return 'number';

        if (is_bool($m)) return 'boolean';

        if (is_null($m)) return 'null';

        return 'string';
    }
}