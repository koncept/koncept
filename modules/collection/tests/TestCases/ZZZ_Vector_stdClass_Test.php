<?php declare(strict_types=1);

namespace Koncept\Tests\Collection\TestCases;

use Koncept\Collection\Common\Exceptions\InvalidContainerOperationException;
use Koncept\Collection\Vector\Vector_stdClass;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;
use stdClass as T;
use TypeError;


/**
 * @internal
 */
class ZZZ_Vector_stdClass_Test extends TestCase
{
    /** @var Vector_stdClass */
    private $model;

    /** @var T */
    private $o1, $o2, $o3;

    public function setUp()
    {
        $this->o1    = new T;
        $this->o1->v = 1;
        $this->o2    = new T;
        $this->o2->v = 2;
        $this->o3    = new T;
        $this->o3->v = 3;

        $this->model = new Vector_stdClass($this->o1, $this->o2);
    }

    public function testIteration()
    {
        $r = [];
        foreach ($this->model as $key => $value) $r[$key] = $value;

        $this->assertEquals([0 => $this->o1, 1 => $this->o2], $r);
    }

    private function strictEq(T ...$expected)
    {
        foreach ($this->model as $key => $value) {
            $this->assertTrue(isset($expected[$key]));
            $this->assertTrue($value === $expected[$key]);
        }
        foreach ($expected as $key => $value) {
            $this->assertTrue(isset($this->model[$key]));
            $this->assertTrue($value === $this->model[$key]);
        }
    }

    public function testPushPop()
    {
        $o1 = $this->o1;
        $o2 = $this->o2;
        $o3 = $this->o3;

        $this->model->push($o3);
        $this->strictEq($o1, $o2, $o3);

        $this->assertTrue($o3 === $this->model->pop());
        $this->strictEq($o1, $o2);

        $this->model->pushFront($o3);
        $this->strictEq($o3, $o1, $o2);

        $this->assertTrue($o3 === $this->model->popFront());
        $this->strictEq($o1, $o2);
    }

    public function testClone()
    {
        $o1 = $this->o1;
        $o2 = $this->o2;

        $original = $this->model;
        $shallow  = clone $this->model;
        $deep     = $this->model->deepClone();

        $this->model = $shallow;
        $this->strictEq($o1, $o2);
        $this->model = $original;

        $this->assertTrue($deep[0] !== $o1);
        $this->assertTrue($deep[1] !== $o2);
        $this->assertTrue(($deep[0]->v ?? -1) == ($o1->v ?? -2));
        $this->assertTrue(($deep[1]->v ?? -1) == ($o2->v ?? -2));
    }

    public function testRemove()
    {
        $this->model->push($this->o3);
        $c1 = clone $this->model;
        $c2 = clone $this->model;
        $c3 = clone $this->model;

        $c1->removeIf(function (int $key): bool {
            return $key === 1;
        });
        $this->model = $c1;
        $this->strictEq($this->o1, $this->o3);

        $c2->removeIf(function (): bool {
            return true;
        });
        $this->model = $c2;
        $this->strictEq();

        $c3->removeIf(function (int $key, T $class): bool {
            return ($class->v ?? -1) === 1;
        });
        $this->model = $c3;
        $this->strictEq($this->o2, $this->o3);
    }

    public function testArrayAccess()
    {
        $this->assertTrue(!isset($this->model[-1]));
        $this->assertTrue(isset($this->model[0]));
        $this->assertTrue(isset($this->model[1]));
        $this->assertTrue(!isset($this->model[2]));

        $this->assertNull($this->model[-1]);
        $this->assertTrue($this->o1 === $this->model[0]);
        $this->assertTrue($this->o2 === $this->model[1]);
        $this->assertNull($this->model[2]);

        $this->model[]  = $this->o3;
        $this->model[3] = $this->o1;
        $this->strictEq($this->o1, $this->o2, $this->o3, $this->o1);
    }

    public function testTypeError1()
    {
        $this->expectException(TypeError::class);
        return isset($this->model['ggrks']);
    }

    public function testTypeError2()
    {
        $this->expectException(TypeError::class);
        return $this->model['ggrks'];
    }

    public function testTypeError3()
    {
        $this->expectException(TypeError::class);
        return $this->model['ggrks'] = $this->o3;
    }

    public function testTypeError4()
    {
        $this->expectException(TypeError::class);
        return $this->model[] = 33 - 4;
    }

    public function testTypeError5()
    {
        $this->expectException(TypeError::class);
        unset($this->model['ggrks']);
    }

    public function testOutOfRange()
    {
        $this->expectException(OutOfRangeException::class);
        $this->model[3] = $this->o3;
    }

    public function testInvalidContainerOperation()
    {
        $this->expectException(InvalidContainerOperationException::class);
        unset($this->model[1]);
    }
}