<?php declare(strict_types=1);

namespace Koncept\Kernel\Logic;

use Koncept\DI\Utility\RecursiveFactory;


/**
 * [Type Map] Logic Factory
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class LogicFactory
    extends RecursiveFactory
{
    /**
     * @param string $type
     * @return bool
     */
    public function supports(string $type): bool
    {
        return parent::supports($type) && is_subclass_of($type, LogicInterface::class, true);
    }
}