<?php
declare(strict_types=1);

namespace App\Components\Base;

use Symfony\Component\Yaml\Yaml;

/**
 * Base Class Config
 */
class Config
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
     * Config constructor.
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
    public static function init(): void
    {
        $filename = sprintf('%s/base.yml', ROOT . '/app/config');

        if (is_readable($filename)) {
            $base = Yaml::parse(file_get_contents($filename));
        }

        self::$_isDebug = getenv('DEBUG');

        if (self::$_isDebug) {
            $filename = sprintf('%s/development.yml', ROOT . '/app/config');
        } else {
            $filename = sprintf('%s/production.yml', ROOT . '/app/config');
        }

        if (is_readable($filename)) {
            $environment = Yaml::parse(file_get_contents($filename));
        }

        self::$_config = array_merge($base, $environment);
    }

    /**
     * @param mixed $component
     *
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
