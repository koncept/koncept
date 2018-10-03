<?php declare(strict_types=1);

namespace Koncept\HTTP;


/**
 * [Interface] Headers
 *
 * Common interface for HTTP headers.
 * This interface only has the responsibility to hold data.
 * In other words, this interface and implementations MUST NOT send headers by themselves.
 *
 * @package koncept/http
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
interface Header
{
    /**
     * Returns the name of HTTP Header.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the value of HTTP Header.
     *
     * @return string
     */
    public function getValue(): string;
}