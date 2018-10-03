<?php declare(strict_types=1);

namespace Koncept\Collection\Vector;

use ArrayAccess;
use Closure;
use Countable;
use IteratorAggregate;
use Koncept\Collection\Common\Exceptions\InvalidContainerOperationException;
use OutOfRangeException;
use stdClass as T;
use Koncept\Collection\Vector\IteratorForVector_stdClass as Iterator_T;
use TypeError;


/**
 * [Class] Vector <stdClass>
 *
 * @package koncept/collection
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class Vector_stdClass implements ArrayAccess, Countable, IteratorAggregate
{
    /** @var array */
    private $data;

    /**
     * Vector_T constructor.
     *
     * @param T ...$elements
     */
    public function __construct(T ...$elements)
    {
        $this->data = $elements;
    }

    /**
     * Push operation.
     *
     * @param T $element
     */
    final public function push(T $element): void
    {
        $this->data[] = $element;
    }

    /**
     * Push operation (front).
     *
     * @param T $element
     */
    final public function pushFront(T $element): void
    {
        array_unshift($this->data, $element);
    }

    /**
     * Pop operation.
     *
     * @return null|T
     */
    final public function pop(): ?T
    {
        return array_pop($this->data);
    }

    /**
     * Pop operation (front).
     *
     * @return null|T
     */
    final public function popFront(): ?T
    {
        return array_shift($this->data);
    }

    /**
     * Deep clone.
     *
     * All the elements will be cloned by this operation.
     *
     * @return self
     */
    final public function deepClone(): self
    {
        $newData = [];
        foreach ($this->data as $value) $newData[] = clone $value;
        return new self(...$newData);
    }

    /**
     * Remove elements.
     *
     * The closure receives key and value as 1st and 2nd arguments respectively.
     * Return true to remove the element and false to keep.
     *
     * @param Closure $closure function (int $key, T $value): bool
     * @return int number of elements removed
     */
    final public function removeIf(Closure $closure): int
    {
        $c = 0;
        foreach ($this->data as $key => $value) if ($closure($key, $value)) {
            unset($this->data[$key]);
            ++$c;
        }
        $this->data = array_values($this->data);
        return $c;
    }

    /**
     * Return an external iterator.
     *
     * @return Iterator_T
     *
     * @internal
     */
    final public function getIterator(): Iterator_T
    {
        return new Iterator_T($this->data);
    }

    /**
     * Return whether a offset exists.
     *
     * @param int $offset
     * @return bool
     *
     * @throws TypeError
     *
     * @internal
     */
    final public function offsetExists($offset): bool
    {
        if (!is_int($offset)) throw new TypeError(self::ArgumentTypeErrorMessage());
        return isset($this->data[$offset]);
    }

    /**
     * Return value associated with the key. If the key is not found, NULL will be returned.
     *
     * @param int $offset
     * @return null|T
     *
     * @throws TypeError
     * @internal
     */
    final public function offsetGet($offset): ?T
    {
        if (!is_int($offset)) throw new TypeError(self::ArgumentTypeErrorMessage());
        return $this->data[$offset] ?? null;
    }

    /**
     * Set value associated with the key. If the key is not found, a new key will be added.
     *
     * @param int $offset
     * @param T $value
     * @return void
     *
     * @throws OutOfRangeException
     * @throws TypeError
     *
     * @internal
     */
    final public function offsetSet($offset, $value): void
    {
        if (!self::CheckType($value)) throw new TypeError(self::ValueTypeErrorMessage());

        if (is_null($offset)) {
            $this->push($value);
        } else if (is_int($offset)) {
            // $offset <= $this->count(): allowing sequential assignment (e.g. for () $container[$i] = $v)
            if (0 <= $offset && $offset <= $this->count()) {
                $this->data[$offset] = $value;
            } else {
                throw new OutOfRangeException("The element #{$offset} is not assignable because the length of this vector is {$this->count()}");
            }
        } else {
            throw new TypeError(self::ArgumentTypeErrorMessage());
        }
    }

    /**
     * Prohibited operation.
     *
     * @param int $offset
     * @return void
     *
     * @throws InvalidContainerOperationException
     * @throws TypeError
     *
     * @internal
     * @deprecated
     */
    final public function offsetUnset($offset): void
    {
        if (!is_int($offset)) throw new TypeError(self::ArgumentTypeErrorMessage());
        throw new InvalidContainerOperationException;
    }

    /**
     * Return the number of elements.
     *
     * @return int
     */
    final public function count(): int
    {
        return count($this->data);
    }

    /**
     * Error message for TypeError.
     *
     * @return string
     */
    private static function ArgumentTypeErrorMessage(): string
    {
        return 'Any keys in this collection must be of the type integer';
    }

    /**
     * Error message for TypeError.
     *
     * @return string
     */
    private static function ValueTypeErrorMessage(): string
    {
        return 'Any values in this collection must be an instance of ' . T::class;
    }

    /**
     * Check if the value is of the expected type
     * @param $value
     * @return bool
     */
    private static function CheckType($value): bool
    {
        return $value instanceof T;
    }
}