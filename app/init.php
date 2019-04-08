<?php
declare(strict_types=1);

use Dotenv\Dotenv;

/**
 * Define project's root
 */
define('ROOT', __DIR__);

/**
 * Load Composer Autoloader
 */
include ROOT . '/../vendor/autoload.php';

/**
 * Load .env
 */
echo ROOT . '/../.env';
if (file_exists(ROOT . '/../.env')) {
    $de = new Dotenv(ROOT);
    $de->load();
}

/**
 * Exception handling.
 */
if (getenv('DEBUG') === 'true') {
    ini_set('display_errors', 1);
    ini_set('error_log', 'php_errors.log');
} else {
    ini_set('display_errors', 0);
}

