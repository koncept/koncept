<?php declare(strict_types=1);

namespace Koncept\Kernel\Config;

use Koncept\DI\Base\FiniteTypeMapAbstract;
use stdClass;
use Strict\Collection\Vector\Scalar\Vector_string;


/**
 * [Type Map] Config Object Provider
 *
 * Clone instance of stdClass of config JSON for each Config classes.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 *
 * @internal
 */
class ConfigObjectProvider
    extends FiniteTypeMapAbstract
{
    /** @var stdClass */
    private $stdClass;

    /**
     * ConfigObjectProvider constructor.
     * @param stdClass $stdClass
     *
     * @internal
     */
    public function __construct(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }

    /**
     * Return the list of supported types.
     * This method will be called only once for each instance.
     *
     * @return Vector_string
     */
    protected function generateList(): Vector_string
    {
        return new Vector_string(stdClass::class);
    }

    /**
     * Acquire object of the type.
     *
     * This method is called inside get() after confirming that the type is supported.
     * So, there is no need to call support() at first in your implementation of this method.
     * In other words, assert($this->support($type)) always passes in this method.
     * Return null at unreachable code. Returning null causes LogicException to be thrown.
     *
     * @param string $type
     * @return null|object
     */
    protected function getObject(string $type): ?object
    {
        return unserialize(serialize($this->stdClass));
    }
}