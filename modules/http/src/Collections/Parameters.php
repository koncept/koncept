<?php declare(strict_types=1);

namespace Koncept\HTTP\Collections;

use Koncept\Collection\Map\String\StringMap_string;
use Koncept\HTTP\Collections\Exceptions\MissingParameterException;


/**
 * [Class] Parameters
 *
 * @package koncept/http
 * @author Showsay You <4kizuki@h4dz.io>
 * @copyright 2018 Koncept
 */
class Parameters extends StringMap_string
{
    /**
     * Return value associated with the key. If the key is not found, an exception will be thrown.
     *
     * @param string $key
     * @return string
     *
     * @throws MissingParameterException
     */
    final public function require(string $key): string
    {
        $ret = $this->get($key);
        if (is_null($ret)) throw new MissingParameterException;
        return $ret;
    }
}