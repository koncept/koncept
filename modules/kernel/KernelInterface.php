<?php declare(strict_types=1);

namespace Koncept\Kernel;

use Koncept\DI\TypeMapInterface;


/**
 * [Interface] Kernel
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
interface KernelInterface
{
    /**
     * Return a factory for Config classes.
     *
     * @return TypeMapInterface
     */
    public function getConfigFactory(): TypeMapInterface;

    /**
     * Return a factory for Repository classes.
     *
     * @return TypeMapInterface
     */
    public function getRepositoryFactory(): TypeMapInterface;

    /**
     * Return a factory for Logic classes.
     *
     * @return TypeMapInterface
     */
    public function getLogicFactory(): TypeMapInterface;

    /**
     * Return a provider of common services.
     * @return TypeMapInterface
     */
    public function getCommonServiceProvider(): TypeMapInterface;
}