<?php

declare(strict_types=1);

namespace App\Components\Models;

class Project extends BaseModel
{
    protected const COLLECTION_NAME = 'projects';

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
     * URO
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
    public $id_added;

    /**
     * Added date
     *
     * @var string|null
     */
    public $dt_added;

    /**
     * User constructor
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
     * Create or Update project
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
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
