<?php declare(strict_types=1);

namespace Koncept\Tests\HTTP\TestCases;

use Koncept\HTTP\Collections\QueryString;
use PHPUnit\Framework\TestCase;


/** @internal */
class ZZZ_QueryString_Test extends TestCase
{
    public function testToString()
    {
        $q = new QueryString([
            'Param1' => 'Good Luck!',
            'Param2' => '(required)'
        ]);

        $this->assertEquals('Param1=Good%20Luck%21&Param2=%28required%29', (string)$q);
    }
}