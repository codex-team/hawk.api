<?php
declare(strict_types=1);

use App\Components\Base\Configs;

/**
 * Define project's root
 */
define('ROOT', dirname(__DIR__));

/**
 * Load Composer Autoloader
 */
include ROOT . '/vendor/autoload.php';

/**
 * Load .env
 */
if (file_exists(ROOT . '/.env')) {
    \Dotenv\Dotenv::create(ROOT)->load();
}

\error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
\mb_internal_encoding('UTF-8');
\date_default_timezone_set('Europe/Moscow');

if (getenv('DEBUG') === 'true') {
    \ini_set('display_errors', 'On');
    \ini_set('error_log', 'php_errors.log');
} else {
    \ini_set('display_errors', 'Off');
}

/**
 * Load configs
 */
Configs::init();
