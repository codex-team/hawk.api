<?php

declare(strict_types=1);

namespace App\Components\Models;

class User extends BaseModel
{
    private const COLLECTION_NAME = 'users';

    /**
     * User's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * Email address
     *
     * @var string|null
     */
    public $email;

    /**
     * Password
     *
     * @var string|null
     */
    public $password;

    /**
     * Return collection name
     *
     * @return string
     */
    protected function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
