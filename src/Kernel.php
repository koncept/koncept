<?php declare(strict_types=1);

namespace Application;

use Koncept\DI\TypeMapInterface;
use Koncept\DI\Utility\AggregateTypeMap;
use Koncept\DI\Utility\Container;
use Koncept\DI\Utility\RecursiveFactory;
use Koncept\Kernel\Config\ConfigFactory;
use Koncept\Kernel\KernelInterface;
use Koncept\Kernel\Logic\LogicFactory;
use Koncept\Kernel\Repository\RepositoryFactory;


/**
 * [Class] Kernel
 *
 * A standard implementation of KernelInterface.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/koncept
 * @since v1.0.0
 */
class Kernel
    implements KernelInterface
{
    /** @var TypeMapInterface */
    private $configFactory;

    /** @var TypeMapInterface */
    private $commonServiceProvider;

    /** @var TypeMapInterface */
    private $repositoryFactory;

    /** @var TypeMapInterface */
    private $logicFactory;

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        $this->configFactory
            = $configFactory = new ConfigFactory(__DIR__ . '/../config');

        $this->commonServiceProvider
            = $commonServiceProvider = new class($configFactory) extends Container
        {
            // use Monolog;
        };

        $injection = (new AggregateTypeMap(
            $configFactory,
            new class($configFactory) extends RecursiveFactory
            {
                // use MySQL;
            },
            $commonServiceProvider
        ));

        $this->repositoryFactory
            = $repositoryFactory = new RepositoryFactory($injection);

        $this->logicFactory
            = new LogicFactory($injection->withTypeMap($repositoryFactory));
    }

    /**
     * Return a factory for Config classes.
     *
     * @return TypeMapInterface
     */
    public function getConfigFactory(): TypeMapInterface
    {
        return $this->configFactory;
    }

    /**
     * Return a factory for Repository classes.
     *
     * @return TypeMapInterface
     */
    public function getRepositoryFactory(): TypeMapInterface
    {
        return $this->repositoryFactory;
    }

    /**
     * Return a factory for Logic classes.
     *
     * @return TypeMapInterface
     */
    public function getLogicFactory(): TypeMapInterface
    {
        return $this->logicFactory;
    }

    /**
     * Return a provider of common services.
     * @return TypeMapInterface
     */
    public function getCommonServiceProvider(): TypeMapInterface
    {
        return $this->commonServiceProvider;
    }
}