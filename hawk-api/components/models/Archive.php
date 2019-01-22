<?php

declare(strict_types=1);

namespace App\Components\Models;

class Archive extends BaseModel
{
    /**
     * Associated collection name
     *
     * @var string
     */
    protected $collectionName = 'archive';

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
}
