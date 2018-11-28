<?php

namespace App\Tests;

use App\Components\Base\Mongo;
use PHPUnit\Framework\TestCase;

class MongoTest extends TestCase
{
    public function testConnection()
    {
        $connection = Mongo::connection();
        $connection->listDatabases();
    }

    public function testDatabase()
    {
        //TODO: write test case for Database connection
    }

    public function testProperSingleton()
    {
        $a = Mongo::connection();
        $b = Mongo::connection();

        $this->assertTrue($a === $b);
    }
}
