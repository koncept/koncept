<?php declare(strict_types=1);

namespace Koncept\Property;

use Koncept\Property\Errors\ReadonlyPropertyError;
use Koncept\Property\Errors\SteadyPropertyError;
use Koncept\Property\Errors\UndefinedPropertyError;
use Koncept\Property\Errors\UnreadablePropertyError;


/**
 * [Trait] Auto Property Read & Write
 *
 * All setters and getters become accessible via property.
 *
 * class T { use AutoProperty; private function getMyProperty(): int { return 3; } }
 * $t = new T;
 * $t->myProperty;   // 3
 *
 * The accessibility of setters and getters do not matter the accessibility of properties.
 *
 * @package koncept/property
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
trait AutoProperty
{
    /**
     * @param string $name
     * @return mixed
     *
     * @throws UndefinedPropertyError
     * @throws UnreadablePropertyError
     *
     * @internal
     */
    public function __get(string $name)
    {
        $getter = [$this, 'get' . strtolower($name)];
        if (is_callable($getter)) return $getter();

        $setter = [$this, 'set' . strtolower($name)];
        if (is_callable($setter)) throw new UnreadablePropertyError(get_class($this), $name);

        throw new UndefinedPropertyError(get_class($this), $name);
    }

    /**
     * @param string $name
     * @param $value
     *
     * @throws UndefinedPropertyError
     * @throws ReadonlyPropertyError
     *
     * @internal
     */
    public function __set(string $name, $value): void
    {
        $setter = [$this, 'set' . strtolower($name)];
        if (is_callable($setter)) {
            $setter($value);
            return;
        }

        $getter = [$this, 'get' . strtolower($name)];
        if (is_callable($getter)) throw new ReadonlyPropertyError(get_class($this), $name);

        throw new UndefinedPropertyError(get_class($this), $name);
    }

    /**
     * @param string $name
     * @return bool
     *
     * @internal
     */
    public function __isset(string $name): bool
    {
        $setter = [$this, 'set' . strtolower($name)];
        $getter = [$this, 'get' . strtolower($name)];
        return is_callable($setter) || is_callable($getter);
    }

    /**
     * @param string $name
     *
     * @throws UndefinedPropertyError
     * @throws SteadyPropertyError
     *
     * @internal
     */
    public function __unset(string $name): void
    {
        $setter = [$this, 'set' . strtolower($name)];
        $getter = [$this, 'get' . strtolower($name)];
        if (is_callable($setter) || is_callable($getter)) throw new SteadyPropertyError(get_class($this), $name);

        throw new UndefinedPropertyError(get_class($this), $name);
    }
}