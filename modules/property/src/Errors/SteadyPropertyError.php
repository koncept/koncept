<?php declare(strict_types=1);

namespace Koncept\Property\Errors;


/**
 * [Error] Tried to Delete a Property
 *
 * @package koncept/property
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class SteadyPropertyError extends PropertyError
{
    public function __construct(string $className, string $propertyName)
    {
        parent::__construct("Tried to delete a property: {$className}::\${$propertyName}");
    }
}