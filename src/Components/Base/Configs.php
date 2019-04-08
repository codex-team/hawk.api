<?php
declare(strict_types=1);

namespace App\Components\Base;

use Symfony\Component\Yaml\Yaml;

/**
 * Base Class Configs
 */
class Configs
{
    /**
     * @var array
     */
    private static $_config = [];

    /**
     * @var bool
     */
    private static $_isDebug = true;

    /**
     * Configs constructor.
     */
    private function __construct()
    {
    }

    /**
     * disable cloning
     */
    private function __clone()
    {
    }

    /**
     * Load base.yml from config file
     */
    public static function init()
    {
        $filename = sprintf('%s/base.yml', ROOT . '/app/config');

        if (is_readable($filename)) {
            $yml = file_get_contents($filename);
            self::$_config = Yaml::parse($yml);
        }

        self::$_isDebug = getenv('DEBUG');
    }

    /**
     * @return array
     */
    public static function get($component = ''): array
    {
        return isset(self::$_config[$component]) ? self::$_config[$component] : [];
    }

    /**
     * @return bool
     */
    public static function isDebug(): bool
    {
        return self::$_isDebug;
    }
}
