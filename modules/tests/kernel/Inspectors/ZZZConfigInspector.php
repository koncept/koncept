<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\Inspectors;

use Koncept\Kernel\Config\ConfigInterface;
use stdClass;


class ZZZConfigInspector implements ConfigInterface
{
    private $value;

    public function __construct(stdClass $value)
    {
        $this->value = $value;
    }

    public function inspect(callable $test): void
    {
        $test($this->value);
    }
}