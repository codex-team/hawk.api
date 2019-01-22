<?php

declare(strict_types=1);

namespace App\Components\Models;

class User extends BaseModel
{
    /**
     * Associated collection name
     *
     * @var string
     */
    protected $collectionName = 'users';

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
}
