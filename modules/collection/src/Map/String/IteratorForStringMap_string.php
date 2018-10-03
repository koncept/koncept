<?php declare(strict_types=1);

namespace Koncept\Collection\Map\String;

use ArrayIterator;
use Iterator;
use Koncept\Collection\Common\Exceptions\InvalidIteratorOperationException;


/**
 * [Class] Iterator for StringMap <string>
 *
 * @package koncept/collection
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class IteratorForStringMap_string implements Iterator
{
    /** @var ArrayIterator */
    private $delegate;

    /**
     * IteratorForStringMap_string constructor.
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
     * @return string
     */
    public function current(): string
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
     * @return string
     */
    public function key(): string
    {
        if ($this->valid()) return (string)$this->delegate->key();
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