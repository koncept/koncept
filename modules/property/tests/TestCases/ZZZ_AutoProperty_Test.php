<?php declare(strict_types=1);

namespace Koncept\Tests\Property\TestCases;

use Koncept\Property\AutoProperty;
use Koncept\Property\Errors\ReadonlyPropertyError;
use Koncept\Property\Errors\SteadyPropertyError;
use Koncept\Property\Errors\UndefinedPropertyError;
use Koncept\Property\Errors\UnreadablePropertyError;
use PHPUnit\Framework\TestCase;


/** @internal */
class ZZZ_AutoProperty_Test extends TestCase
{
    use AutoProperty;

    private $rp;

    public function setUp()
    {
        $this->rp = '';
    }

    private function getReadonlyProperty(): string
    {
        return 'readonly property';
    }

    private function setUnreadableProperty(string $v): void
    {
        $this->rp = $v;
    }

    public function testGetS()
    {
        $this->assertEquals('readonly property', $this->readonlyProperty);
    }

    public function testGetE1()
    {
        $this->expectException(UnreadablePropertyError::class);
        return $this->unreadableProperty;
    }

    public function testGetE2()
    {
        $this->expectException(UndefinedPropertyError::class);
        return $this->undefinedProperty;
    }

    public function testSetS()
    {
        $this->unreadableProperty = 'unreadable property';
        $this->assertEquals('unreadable property', $this->rp);
    }

    public function testSetE1()
    {
        $this->expectException(ReadonlyPropertyError::class);
        $this->readonlyProperty = 'readonly property';
    }

    public function testSetE2()
    {
        $this->expectException(UndefinedPropertyError::class);
        $this->undefinedProperty = 'undefined property';
    }

    public function testIsset()
    {
        $this->assertTrue(isset($this->readonlyProperty));
        $this->assertTrue(isset($this->unreadableProperty));
        $this->assertFalse(isset($this->undefinedProperty));
    }

    public function testUnsetE1()
    {
        $this->expectException(SteadyPropertyError::class);
        unset($this->readonlyProperty);
    }

    public function testUnsetE2()
    {
        $this->expectException(SteadyPropertyError::class);
        unset($this->unreadableProperty);
    }

    public function testUnsetE3()
    {
        $this->expectException(UndefinedPropertyError::class);
        unset($this->undefinedProperty);
    }
}