<?php

declare(strict_types=1);

namespace App\Components\Models;

class User extends BaseModel
{
    protected const COLLECTION_NAME = 'users';

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
        $mongoResult = $this->baseSync($this->rawArgs);

        $this->fillModel($mongoResult);
    }

    /**
     * Return collection name
     *
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
