<?php

namespace Koncept\Request\Components;

use Strict\Collection\Vector\Scalar\Vector_string;


/**
 * Interface HeaderDirectivesInterface
 * @package Koncept\Request\Components
 *
 * @property null|Vector_string $acceptLanguage
 * @property null|Vector_string $acceptEncoding
 */
interface HeaderDirectivesInterface
    extends DirectivesContainerInterface
{
}