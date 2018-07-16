<?php declare(strict_types=1);

namespace Koncept\Request\Components;

use ArrayAccess;
use Countable;
use IteratorAggregate;


/**
 * [Interface] Container of Query Parameters
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/request
 * @since v1.0.0
 */
interface QueryParametersContainerInterface
    extends ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     *
     * @return QueryParametersIteratorInterface
     *
     * @internal
     */
    public function getIterator(): QueryParametersIteratorInterface;

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset an offset to check for.
     * @return boolean true on success or false on failure.
     *
     * @internal
     */
    public function offsetExists($offset): bool;

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset the offset to retrieve.
     * @return null|string
     *
     * @internal
     */
    public function offsetGet($offset): ?string;

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param string $offset the offset to assign the value to.
     * @param null|string $value the value to set.
     * @return void
     *
     * @internal
     */
    public function offsetSet($offset, $value): void;

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset the offset to unset.
     * @return void
     *
     * @internal
     */
    public function offsetUnset($offset): void;

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     *
     * @return int the custom count as an integer.
     *
     * @internal
     */
    public function count(): int;
}