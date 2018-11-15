<?php

namespace App\Components\Models;

use App\Components\Base\Mongo;

class User extends BaseModel
{
    /**
     * User's unique identifier
     *
     * @var string|null
     */
    public $id;

    /**
     * User's nickname
     *
     * @var string|null
     */
    public $name;

    /**
     * User's email address
     *
     * @var string|null
     */
    public $email;

    /**
     * User's password
     *
     * @var string|null
     */
    public $password;

    public function __construct(array $args = [])
    {
        if (!empty($args)) {
            $this->fillModel($args);
        }
    }

    /**
     * Create or update User
     */
    public function sync()
    {
        var_dump(Mongo::database()->users->insertOne(['name' => 'adasda']));
    }

    /**
     * Find user by $id
     *
     * @param int $id
     */
    public function find(int $id)
    {

    }

    /**
     * Return collection name
     *
     * @return string
     */
    public function collectionName(): string
    {
        return 'users';
    }
}
