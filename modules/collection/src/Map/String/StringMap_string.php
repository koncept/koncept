<?php declare(strict_types=1);

namespace Koncept\Collection\Map\String;

use ArrayAccess;
use IteratorAggregate;
use Koncept\Collection\Common\Exceptions\PushDeniedException;
use TypeError;


/**
 * [Class] StringMap <string>
 *
 * StringMap stands for Map <string, *>
 *
 * @package koncept/collection
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class StringMap_string implements ArrayAccess, IteratorAggregate
{
    /** @var array */
    private $data;

    /**
     * StringMap_string constructor.
     *
     * @param array $input
     */
    public function __construct(array $input)
    {
        $d = [];
        foreach ($input as $key => $value) if (is_string($value)) $d[$key] = $value;
        $this->data = $d;
    }

    /**
     * Return whether this has a key or not.
     *
     * @param string $key
     * @return bool
     */
    final public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * Return value associated with the key. If the key is not found, NULL will be returned.
     *
     * @param string $key
     * @return null|string
     */
    final public function get(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }

    /**
     * Set value associated with the key. If the key is not found, a new key will be added.
     *
     * @param string $key
     * @param string $value
     */
    final public function set(string $key, string $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Remove the pair of the key and the associated value from this map.
     *
     * @param string $key
     * @return bool whether an existing pair is removed or not.
     */
    final public function remove(string $key): bool
    {
        if (!$this->has($key)) return false;

        unset($this->data[$key]);
        return true;
    }

    /**
     * Return an external iterator.
     *
     * @return IteratorForStringMap_string
     *
     * @internal
     */
    final public function getIterator(): IteratorForStringMap_string
    {
        return new IteratorForStringMap_string($this->data);
    }

    /**
     * Return whether a offset exists.
     *
     * @param string|int $offset
     * @return bool
     *
     * @internal
     */
    final public function offsetExists($offset): bool
    {
        return $this->has((string)$offset);
    }

    /**
     * Return value associated with the key. If the key is not found, NULL will be returned.
     *
     * @param string|int $offset
     * @return null|string
     *
     * @internal
     */
    final public function offsetGet($offset): ?string
    {
        return $this->get((string)$offset);
    }

    /**
     * Set value associated with the key. If the key is not found, a new key will be added.
     *
     * @param string|int $offset
     * @param string $value
     * @return void
     *
     * @internal
     */
    final public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) throw new PushDeniedException;
        if (!is_string($value)) throw new TypeError(self::ValueTypeErrorMessage());

        $this->set((string)$offset, $value);
    }

    /**
     * Remove the pair of the key and the associated value from this map.
     *
     * @param string|int $offset
     * @return void
     *
     * @internal
     */
    final public function offsetUnset($offset): void
    {
        $this->remove((string)$offset);
    }

    /**
     * Error message for TypeError.
     *
     * @return string
     */
    private static function ValueTypeErrorMessage(): string
    {
        return 'Any values in this collection must be of the type string';
    }
}