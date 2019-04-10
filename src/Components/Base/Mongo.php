<?php

declare(strict_types=1);

namespace App\Components\Base;

use MongoDB\ {
    Client,
    Database
};

/**
 * Singleton
 *
 * Class Mongo
 *
 * @package App\Components\Base
 */
class Mongo
{
    /**
     * Connection to Mongo
     *
     * @var Client
     */
    private static $connection;

    /**
     * Mongo constructor that can't be called.
     */
    private function __construct()
    {
    }

    /**
     * Disable cloning
     */
    private function __clone()
    {
    }

    /**
     * Get connection to Mongo
     *
     * @param string|null $database
     *
     * @return Client
     */
    public static function connection(): Client
    {
        if (!isset(self::$connection)) {
            self::$connection = new Client(
                sprintf('mongodb://%s:%s', Configs::get('mongo')['host'], Configs::get('mongo')['port']), [],
                [
                    'typeMap' => [
                        'array' => 'array',
                        'document' => 'array',
                        'root' => 'array',
                    ],
                ]
            );
        }

        return self::$connection;
    }

    /**
     * Connect to the database.
     *
     * @param string|null $database
     *
     * @return \MongoDB\Database
     */
    public static function database(string $database = null): Database
    {
        return self::connection()->selectDatabase(Configs::get('mongo')['db'] ?? $database);
    }
}
