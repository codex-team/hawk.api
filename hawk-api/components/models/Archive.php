<?php

declare(strict_types=1);

namespace App\Components\Models;

class Archive extends BaseModel
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
     * Project's id archive related to
     *
     * @var string|null
     */
    public $project_id;

    /**
     * User's role
     *
     * @var string|null
     */
    public $role;

    /**
     * Archive's tag
     *
     * @var string
     */
    public $tag;

    /**
     * Archive's count of archived errors
     *
     * @var int|null
     */
    public $archived;

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
            $this->fillModel($args);
        }
    }

    /**
     * Create or Update archive
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
