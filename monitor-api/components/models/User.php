<?php

declare(strict_types=1);

namespace App\Components\Models;

class User extends BaseModel
{
    const COLLECTION_NAME = 'users';

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

    /**
     * Raw arguments for updating/inserting.
     *
     * @var array
     */
    public $rawArgs;

    /**
     * User constructor.
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        if (!empty($args)) {
            $this->rawArgs = $args;
            $this->fillModel($args);
        }
    }

    /**
     * Create or Update user
     *
     * @throws \Exception
     */
    public function sync(): void
    {
        $mongoResult = $this->baseSync($this->id, $this->rawArgs);

        $this->fillModel($mongoResult);
    }

    /**
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
