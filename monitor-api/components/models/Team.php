<?php

declare(strict_types=1);

namespace App\Components\Models;

class Team extends BaseModel
{
    // TODO: разобраться с "collection:<project._id>"
    protected const COLLECTION_NAME = '';

    /**
     * Membership's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * User's id which take part
     *
     * @var string|null
     */
    public $user_id;

    /**
     * User's role
     *
     * @var string|null
     */
    public $role;

    /**
     * Pending status
     *
     * @var array
     */
    public $is_pending;

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
        $mongoResult = $this->baseSync($this->_id, $this->rawArgs);

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
