<?php

declare(strict_types=1);

namespace App\Components\Models;

class Project extends BaseModel
{
    const COLLECTION_NAME = 'projects';

    /**
     * Project's unique identifier
     *
     * @var string|null
     */
    public $id;

    /**
     * Project's alias
     *
     * @var string|null
     */
    public $name;

    /**
     * Project's URL
     *
     * @var string|null
     */
    public $url;

    /**
     * Project's WebHook
     *
     * @var array
     */
    public $webhooks;

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
        $mongoResult = $this->baseSync($this->id, $this->rawArgs);

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
