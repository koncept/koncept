<?php declare(strict_types=1);

namespace Koncept\Tests\HTTP\TestCases;

use Koncept\HTTP\Collections\Exceptions\MissingParameterException;
use Koncept\HTTP\Collections\Parameters;
use PHPUnit\Framework\TestCase;


/** @internal */
class ZZZ_Parameters_Test extends TestCase
{
    public function testRequire()
    {
        $p = new Parameters([
            'Esperanto Greeting' => 'Saluton!'
        ]);

        $this->assertEquals('Saluton!', $p->require('Esperanto Greeting'));

        $this->expectException(MissingParameterException::class);
        $p->require('something');
    }
}