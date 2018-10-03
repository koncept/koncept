<?php declare(strict_types=1);

namespace Koncept\Property\Errors;


/**
 * [Error] Tried to Read an Unreadable Property
 *
 * @package koncept/property
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class UnreadablePropertyError extends PropertyError
{
    public function __construct(string $className, string $propertyName)
    {
        parent::__construct("Unreadable property: {$className}::\${$propertyName}");
    }
}