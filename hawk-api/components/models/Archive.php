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
    public $projectId;

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
     * Return collection name
     *
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
