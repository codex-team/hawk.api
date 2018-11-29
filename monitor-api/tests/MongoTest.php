<?php

namespace App\Tests;

use App\Components\Base\Mongo;
use MongoDB\Driver\Exception\ConnectionTimeoutException;
use PHPUnit\Framework\TestCase;

class MongoTest extends TestCase
{
    public function testConnection(): void
    {
        $connection = Mongo::connection();

        try {
            $connection->listDatabases();
        } catch (ConnectionTimeoutException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testDatabase(): void
    {
        $connection = Mongo::database();
        $this->assertEquals(getenv('MONGO_DB'), $connection->getDatabaseName());
    }

    public function testProperSingleton(): void
    {
        $a = Mongo::connection();
        $b = Mongo::connection();

        $this->assertTrue($a === $b);
    }
}
