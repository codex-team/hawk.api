<?php

declare(strict_types=1);

namespace App\Schema;

use App\Schema\Types\{
    Mutation,
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
    private static $mutation;
    private static $user;
    private static $project;
    private static $response;

    /**
     * @return Query
     */
    public static function query(): Query
    {
        return self::$query ?: (self::$query = new Query());
    }

    /**
     * @return Mutation
     */
    public static function mutation(): Mutation
    {
        return self::$mutation ?: (self::$mutation = new Mutation());
    }

    /**
     * @return User
     */
    public static function user(): User
    {
        return self::$user ?: (self::$user = new User());
    }

    /**
     * @return Project
     */
    public static function project(): Project
    {
        return self::$project ?: (self::$project = new Project());
    }

    /**
     * @return Response
     */
    public static function response(): Response
    {
        return self::$response ?: (self::$response = new Response());
    }
}
