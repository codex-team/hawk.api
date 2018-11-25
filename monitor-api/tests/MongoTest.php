<?php

namespace App\Tests;

use App\Components\Base\Mongo;
use PHPUnit\Framework\TestCase;

class MongoTest extends TestCase
{
    public function testProperSingleton()
    {
        $a = Mongo::connection();
        $b = Mongo::connection();

        $this->assertTrue($a === $b);
    }

    public function testConnection()
    {
        //TODO: write test case for Mongo connection
    }

    public function testDatabase()
    {
        //TODO: write test case for Database connection
    }
}
