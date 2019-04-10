<?php

/**
 * Define project's root
 */
define('ROOT', dirname(__DIR__));

ini_set('display_errors', 1);
ini_set('error_log', 'php_errors.log');

/**
 * Load Composer Autoloader
 */
require_once ROOT . '/vendor/autoload.php';

/**
 * Load .env
 */
if (file_exists(ROOT . '/.env')) {
    $de = new \Dotenv\Dotenv(ROOT);
    $de->load();
}
