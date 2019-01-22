<?php

declare(strict_types=1);

namespace App\Tests;

use App\Components\Base\Mongo;
use MongoDB\Driver\Exception\ConnectionTimeoutException;
use PHPUnit\Framework\TestCase;

class MongoTest extends TestCase
{
    /**
     * Test connection establishing
     */
    public function testConnection(): void
    {
        $connection = Mongo::connection();

        try {
            $connection->listDatabases();
        } catch (ConnectionTimeoutException $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * Test database availability
     */
    public function testDatabase(): void
    {
        $connection = Mongo::database();
        $this->assertEquals(getenv('MONGO_DB'), $connection->getDatabaseName());
    }

    /**
     * Test singleton working
     */
    public function testProperSingleton(): void
    {
        $a = Mongo::connection();
        $b = Mongo::connection();

        $this->assertTrue($a === $b);
    }
}
