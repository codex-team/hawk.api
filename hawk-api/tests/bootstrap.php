<?php

/**
 * Define project's root
 */
define('ROOT', dirname(__DIR__));

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
