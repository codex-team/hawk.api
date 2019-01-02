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
            $this->fillModel($args);
        }
    }

    /**
     * Create or Update user
     *
     * @param $args array
     *
     * @throws \Exception
     */
    public function sync(array $args): void
    {
        $this->fillModel($this->baseSync($args));
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
