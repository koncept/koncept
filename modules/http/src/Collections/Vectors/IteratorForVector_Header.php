<?php declare(strict_types=1);

namespace Koncept\HTTP\Collections\Vectors;

use ArrayIterator;
use Iterator;
use Koncept\Collection\Common\Exceptions\InvalidIteratorOperationException;
use Koncept\HTTP\Header as T;


/**
 * [Class] Iterator for Vector <Header>
 *
 * @package koncept/collection
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class IteratorForVector_Header implements Iterator
{
    /** @var ArrayIterator */
    private $delegate;

    /**
     *IteratorForVector_T constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->delegate = new ArrayIterator($data);
    }

    /**
     * Return the current element.
     *
     * @return T
     */
    public function current(): T
    {
        if ($this->valid()) return $this->delegate->current();
        throw new InvalidIteratorOperationException;
    }

    /**
     * Move forward to next element.
     *
     * @return void
     */
    public function next(): void
    {
        if (!$this->valid()) throw new InvalidIteratorOperationException;
        $this->delegate->next();
    }

    /**
     * Return the key of the current element.
     *
     * @return int
     */
    public function key(): int
    {
        if ($this->valid()) return (int)$this->delegate->key();
        throw new InvalidIteratorOperationException;
    }

    /**
     * Checks if current position is valid.
     *
     * @return boolean
     */
    public function valid(): bool
    {
        return $this->delegate->valid();
    }

    /**
     * Rewind the Iterator to the first element.
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->delegate->rewind();
    }
}