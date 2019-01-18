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
     * Role type
     *
     * @var string|null
     */
    public $role;

    /**
     * Pending status
     *
     * @var bool|null
     */
    public $is_pending;

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
     * Create or Update team
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
