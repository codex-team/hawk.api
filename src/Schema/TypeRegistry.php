<?php
declare(strict_types=1);

namespace App\Schema;

use App\Schema\Types\Requests\{
    Mutation,
    Query
};

use App\Schema\Types\{
    Archive,
    Membership,
    Project,
    Team,
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
    private static $archive;
    private static $membership;
    private static $team;

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
     * @return Archive
     */
    public static function archive(): Archive
    {
        return self::$archive ?: (self::$archive = new Archive());
    }

    /**
     * @return Membership
     */
    public static function membership(): Membership
    {
        return self::$membership ?: (self::$membership = new Membership());
    }

    /**
     * @return Team
     */
    public static function team(): Team
    {
        return self::$team ?: (self::$team = new Team());
    }
}
