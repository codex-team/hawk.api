<?php

declare(strict_types=1);

namespace App\Components\Models;

class Project extends BaseModel
{
    protected const COLLECTION_NAME = 'projects';

    /**
     * Project's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * Owner's unique identifier
     *
     * @var string|null
     */
    public $id_added;

    /**
     * Project's token
     *
     * @var string|null
     */
    public $token;

    /**
     * Project's alias
     *
     * @var string|null
     */
    public $name;

    /**
     * Project's description
     *
     * @var string|null
     */
    public $description;

    /**
     * Project's domain
     *
     * @var string|null
     */
    public $domain;

    /**
     * Project's URI
     *
     * @var string|null
     */
    public $uri;

    /**
     * Project's WebHook
     *
     * @var string|null
     */
    public $logo;

    /**
     * Added date
     *
     * @var string|null
     */
    public $dt_added;

    /**
     * Raw arguments for updating/inserting
     *
     * @var array
     */
    public $rawArgs;

    /**
     * User constructor
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
     * Create or Update project
     *
     * @throws \Exception
     */
    public function sync(): void
    {
        $mongoResult = $this->baseSync($this->rawArgs);

        $this->fillModel($mongoResult);
    }

    /**
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
