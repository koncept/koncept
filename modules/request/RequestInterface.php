<?php

namespace Koncept\Request;

use Koncept\Request\Components\DirectivesContainerInterface;
use Koncept\Request\Components\DirectivesIteratorInterface;
use Koncept\Request\Components\ParametersContainerInterface;

/**
 * [Interface] HTTP Request Line
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/request
 * @since v1.0.0
 *
 * @property string $protocol
 * @property string $method
 * @property string $schema
 * @property string $host
 * @property int $port
 * @property string $path
 * @property null|string $query
 * @property-read string $uri
 * @property ParametersContainerInterface $queryParameters
 * @property ParametersContainerInterface $bodyParameters
 * @property DirectivesContainerInterface $cookies
 * @property string $body
 * @property-read array $files
 * @property DirectivesIteratorInterface $headers
 * @property array $client
 * @property int $time
 * @property float $timeFloat
 */
interface RequestInterface
{
    /** Synchronize query with a container of query parameters. */
    public function synchronizeQuery(): void;
}