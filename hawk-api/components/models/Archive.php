<?php

declare(strict_types=1);

namespace App\Components\Models;

class Archive extends BaseModel
{
    protected const COLLECTION_NAME = 'archive';

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
     * Tag
     *
     * @var string|null
     */
    public $tag;

    /**
     * Count of archived errors
     *
     * @var int|null
     */
    public $archived;

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
