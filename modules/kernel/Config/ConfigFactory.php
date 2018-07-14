<?php declare(strict_types=1);

namespace Koncept\Kernel\Config;

use Koncept\DI\Utility\RecursiveFactory;
use Koncept\Kernel\Exceptions\FileNotFoundException;
use Koncept\Kernel\Exceptions\InvalidConfigException;
use Koncept\Kernel\Exceptions\JsonMergeException;
use stdClass;


/**
 * [Type Map] Config Factory
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class ConfigFactory
    extends RecursiveFactory
{
    /**
     * ConfigFactory constructor.
     * Read JSONs and merge them if needed.
     *
     * @param string $configDir
     */
    public function __construct(string $configDir)
    {
        $comF = $configDir . DIRECTORY_SEPARATOR . 'common.json';
        $envF = $configDir . DIRECTORY_SEPARATOR . 'environment.json';

        if (!file_exists($comF)) throw FileNotFoundException::FromFileName($comF);
        $com = self::TakeJson($comF);

        if (file_exists($envF)) $res = self::MergeJson($com, self::TakeJson($envF));
        else $res = $com;

        parent::__construct(new ConfigObjectProvider($res));
    }

    /**
     * @param string $type
     * @return bool
     */
    public function supports(string $type): bool
    {
        return parent::supports($type) && is_subclass_of($type, ConfigInterface::class);
    }

    private static function TakeJson(string $existingFile): stdClass
    {
        $res = json_decode(file_get_contents($existingFile));
        if ($res instanceof stdClass) return $res;
        throw InvalidConfigException::FromFileName($existingFile);
    }

    private static function MergeJson(stdClass $i, stdClass $j, string $accessKey = ''): stdClass
    {
        if ($accessKey !== '') $accessKey = $accessKey . '.';

        $res = clone $i;
        foreach ($j as $key => $jCont) {
            $currentKey = $accessKey . $key;

            if (!isset($res->{$key})) {
                $res->{$key} = $jCont;
                continue;
            }

            $iCont = $res->{$key};
            if ($iCont instanceof stdClass) {
                if ($jCont instanceof stdClass) {
                    $res->{$key} = self::MergeJson($iCont, $jCont, $currentKey);
                    continue;
                } else {
                    throw JsonMergeException::FromType($currentKey, 'object', $jCont);
                }
            } else if (is_array($iCont)) {
                if (is_array($jCont)) {
                    $res->{$key} = $jCont;
                    continue;
                } else {
                    throw JsonMergeException::FromType($currentKey, 'array', $jCont);
                }
            } else {
                $res->{$key} = $jCont;
            }
        }

        return $res;
    }
}