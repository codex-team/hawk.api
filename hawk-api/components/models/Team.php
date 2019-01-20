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
    public $userId;

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
    public $isPending;

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
     * Return collection name
     *
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
