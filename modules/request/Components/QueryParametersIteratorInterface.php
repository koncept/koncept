<?php declare(strict_types=1);

namespace Koncept\Request\Components;

use Iterator;


/**
 * [Interface] Iterator of Query Parameters
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/request
 * @since v1.0.0
 */
interface QueryParametersIteratorInterface
    extends Iterator
{
    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     *
     * @return null|string
     */
    public function current(): ?string;

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     *
     * @return void
     */
    public function next(): void;

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     *
     * @return null|string string on success or null on failure.
     */
    public function key(): ?string;

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     *
     * @return boolean true on success or false on failure.
     */
    public function valid(): bool;

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     *
     * @return void
     */
    public function rewind(): void;
}