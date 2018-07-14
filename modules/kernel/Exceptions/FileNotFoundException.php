<?php declare(strict_types=1);

namespace Koncept\Kernel\Exceptions;

use RuntimeException;


/**
 * [Exception] File Not Found Exception
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class FileNotFoundException
    extends RuntimeException
{
    /**
     * @param string $fileName
     * @return FileNotFoundException
     */
    public static function FromFileName(string $fileName): self
    {
        return new self("The required file {$fileName} is missing.");
    }
}