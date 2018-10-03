<?php declare(strict_types=1);

namespace Koncept\Property\Errors;


/**
 * [Error] Access to an Undefined Property
 *
 * @package koncept/property
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class UndefinedPropertyError extends PropertyError
{
    public function __construct(string $className, string $propertyName)
    {
        parent::__construct("Undefined property: {$className}::\${$propertyName}");
    }
}