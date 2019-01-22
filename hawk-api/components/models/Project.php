<?php

declare(strict_types=1);

namespace App\Components\Models;

final class Project extends BaseModel
{
    /**
     * Associated collection name
     *
     * @var string
     */
    protected $collectionName = 'projects';

    /**
     * Unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * Token
     *
     * @var string|null
     */
    public $token;

    /**
     * Alias
     *
     * @var string|null
     */
    public $name;

    /**
     * Description
     *
     * @var string|null
     */
    public $description;

    /**
     * Domain
     *
     * @var string|null
     */
    public $domain;

    /**
     * Project's website
     *
     * @var string|null
     */
    public $uri;

    /**
     * Logo URL
     *
     * @var string|null
     */
    public $logo;

    /**
     * Owner's unique identifier
     *
     * @var string|null
     */
    public $uidAdded;

    /**
     * Added date
     *
     * @var string|null
     */
    public $dtAdded;
}
