<?php

namespace App\Schema;

use App\Schema\Types\{
    Project,
    Query,
    Response,
    User
};

/**
 * Class TypeRegistry
 *
 * @package App\Schema
 */
class TypeRegistry
{
    /**
     * Custom types for GraphQL
     */
    private static $query;
    private static $user;
    private static $project;
    private static $response;

    /**
     * @return Query
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new Query());
    }

    /**
     * @return User
     */
    public static function user()
    {
        return self::$user ?: (self::$user = new User());
    }

    /**
     * @return Project
     */
    public static function project()
    {
        return self::$project ?: (self::$project = new Project());
    }

    /**
     * @return Response
     */
    public static function response()
    {
        return self::$response ?: (self::$response = new Response());
    }
}