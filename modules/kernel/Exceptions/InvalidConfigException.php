<?php declare(strict_types=1);

namespace Koncept\Kernel\Exceptions;

use RuntimeException;


/**
 * [Exception] Invalid Config Exception
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class InvalidConfigException
    extends RuntimeException
{
    /**
     * @param string $fileName
     * @return InvalidConfigException
     */
    public static function FromFileName(string $fileName): self
    {
        return new self("The configs in the file {$fileName} is invalid.");
    }
}