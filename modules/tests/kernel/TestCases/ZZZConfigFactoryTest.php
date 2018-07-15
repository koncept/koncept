<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestCases;

use Koncept\Kernel\Config\ConfigFactory;
use Koncept\Kernel\Exceptions\FileNotFoundException;
use Koncept\Kernel\Exceptions\InvalidConfigException;
use Koncept\Kernel\Exceptions\JsonMergeException;
use Koncept\Kernel\Tests\Inspectors\ZZZConfigInspector;
use PHPUnit\Framework\TestCase;
use stdClass;


class ZZZConfigFactoryTest
    extends TestCase
{
    private static function acquire(string $title): ZZZConfigInspector
    {
        $fact = new ConfigFactory(__DIR__ . '/../Resources/' . $title);
        /** @var ZZZConfigInspector $ret */
        $ret = $fact->get(ZZZConfigInspector::class);
        return $ret;
    }

    public function testSimple()
    {
        $inspector = self::acquire('simple');
        $inspector->inspect(function (stdClass $value) {
            $this->assertTrue($value->server instanceof stdClass);
        });
    }

    public function testNotFound()
    {
        $this->expectException(FileNotFoundException::class);
        self::acquire('not-found');
    }

    public function testInvalidCommon()
    {
        $this->expectException(InvalidConfigException::class);
        self::acquire('invalid-common');
    }

    public function testInvalidEnvironment()
    {
        $this->expectException(InvalidConfigException::class);
        self::acquire('invalid-environment');
    }

    public function testMerge()
    {
        $inspector = self::acquire('merge');
        $inspector->inspect(function (stdClass $value) {
            $this->assertTrue($value->kept === 4.2);
            $this->assertTrue($value->scalar === 4);
            $this->assertTrue($value->array[0] === 'f');
            $this->assertTrue($value->object instanceof stdClass);
            $this->assertTrue($value->object->kept === 5);
            $this->assertTrue($value->object->scalar === 3);
            $this->assertTrue($value->object->array[0] === 'n');
            $this->assertTrue($value->object->object->scalar === 7);
        });
    }

    public function testTypeError1()
    {
        $this->expectException(JsonMergeException::class);
        self::acquire('merge-type-error-1');
    }

    public function testTypeError2()
    {
        $this->expectException(JsonMergeException::class);
        self::acquire('merge-type-error-2');
    }
}