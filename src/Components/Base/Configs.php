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
    public static function init(): void
    {
        $filename = sprintf('%s/base.yml', ROOT . '/app/config');

        if (is_readable($filename)) {
            $base = file_get_contents($filename);
            $base_config = Yaml::parse($base);
        }

        self::$_isDebug = getenv('DEBUG');

        if (self::$_isDebug) {
            $additional = sprintf('%s/development.yml', ROOT . '/app/config');
        } else {
            $additional = sprintf('%s/production.yml', ROOT . '/app/config');
        }

        if (is_readable($additional)) {
            $environment = file_get_contents($additional);
            $environment_config = Yaml::parse($environment);
        }

        self::$_config = array_merge($base_config, $environment_config);
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
