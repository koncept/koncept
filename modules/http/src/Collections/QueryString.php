<?php declare(strict_types=1);

namespace Koncept\HTTP\Collections;


/**
 * [Class] QueryString
 *
 * @package koncept/http
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class QueryString extends Parameters
{
    /** @return string */
    final public function __toString(): string
    {
        $r = [];
        foreach ($this as $key => $value) $r[$key] = $value;
        return http_build_query($r, '', '&', PHP_QUERY_RFC3986);
    }
}