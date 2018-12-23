<?php

declare(strict_types=1);

namespace App\Schema;

use App\Schema\Types\{
    Project,
    User
};

use App\Schema\Types\Requests\{
    Query,
    Mutation
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
}
