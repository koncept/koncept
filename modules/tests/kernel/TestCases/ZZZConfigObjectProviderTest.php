<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestCases;

use Koncept\Kernel\Config\ConfigObjectProvider;
use PHPUnit\Framework\TestCase;
use stdClass;


class ZZZConfigObjectProviderTest
    extends TestCase
{
    public function testBehavior()
    {
        $p = new ConfigObjectProvider($o = new stdClass);

        $this->assertTrue($o == $p->get(stdClass::class));
        $this->assertFalse($o === $p->get(stdClass::class));
        $this->assertTrue($p->get(stdClass::class) == $p->get(stdClass::class));
        $this->assertFalse($p->get(stdClass::class) === $p->get(stdClass::class));
    }
}