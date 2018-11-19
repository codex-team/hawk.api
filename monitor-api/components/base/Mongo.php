<?php

declare(strict_types=1);

namespace App\Components\Base;

use MongoDB\Client as Client;

class Mongo
{
    private static $connection;
    private static $instance;

    /**
     * Get connection to mongo
     *
     * @param string|null $database
     *
     * @return Client
     */
    public static function connection(string $database = null)
    {
        if (!isset(self::$instance)) {
            self::$instance = new Mongo();
        }

        if (!isset(self::$connection)) {
            $domain = getenv('MONGO_HOST') ?? 'localhost';
            $port = getenv('MONGO_PORT') ?? 27017;

            self::$connection = new Client(
                "mongodb://{$domain}:{$port}", [],
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
    public static function database(string $database = null)
    {
        $db = $database ?? getenv('MONGO_DB');

        return self::connection()->selectDatabase($db);
    }
}
