<?php declare(strict_types=1);

namespace Koncept\Tests\Collection\TestCases;

use Koncept\Collection\Common\Exceptions\PushDeniedException;
use Koncept\Collection\Map\String\StringMap_string;
use PHPUnit\Framework\TestCase;
use TypeError;


/** @internal */
class ZZZ_StringMap_string_Test extends TestCase
{
    /** @var StringMap_string */
    private $model;

    public function setUp()
    {
        $this->model = new StringMap_string([
            'string' => 'Hello, World!',
            33 - 4   => 'Integer Key',
        ]);
    }

    public function testInvalidValue()
    {
        $this->expectException(TypeError::class);
        new StringMap_string(['integer' => 33 - 4]);
    }

    public function testPush()
    {
        $this->expectException(PushDeniedException::class);
        $this->model[] = '33';
    }

    public function testInvalidAssign()
    {
        $this->expectException(TypeError::class);
        $this->model['key'] = (object)[];
    }

    public function testBehavior()
    {
        $this->assertTrue($this->model->has('string'));
        $this->assertTrue($this->model->has('29'));
        $this->assertFalse($this->model->has('something'));

        $this->assertEquals('Hello, World!', $this->model->get('string'));
        $this->assertEquals('Integer Key', $this->model->get('29'));
        $this->assertNull($this->model->get('something'));

        $this->model->set('Hello in Esperanto', 'Saluton!');
        $this->assertTrue($this->model->has('Hello in Esperanto'));
        $this->assertEquals('Saluton!', $this->model->get('Hello in Esperanto'));

        $this->assertTrue($this->model->remove('string'));
        $this->assertFalse($this->model->remove('something'));
        $this->assertFalse($this->model->has('string'));
        $this->assertTrue($this->model->has('29'));

        $p = [];
        $c = 0;
        foreach ($this->model as $key => $value) {
            $p[$key] = $value;
            $c++;
        }

        $this->assertEquals(2, $c);
        $this->assertEquals([
            '29'                 => 'Integer Key',
            'Hello in Esperanto' => 'Saluton!'
        ], $p);
    }
}