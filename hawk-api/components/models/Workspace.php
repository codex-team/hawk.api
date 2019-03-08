<?php

namespace App\Components\Models;

final class Workspace extends BaseModel
{
    /**
     * Associated collection's name
     *
     * @var string
     */
    protected $collectionName = 'workspaces';

    /**
     * Workspace's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * Workspace title
     *
     * @var string|null
     */
    public $name;

    /**
     * Logo image URL
     *
     * @var string|null
     */
    public $logo;

    /**
     * Contains ids of participants
     *
     * @var array|null
     */
    public $users;

    /**
     * Contains ids of projects
     *
     * @var array|null
     */
    public $projects;

    /**
     * Convert array of string Id to ObjectId
     *
     * @param array $args
     */
    public function sync(array $args): void
    {
        $args = array_merge($args, [
            'users' => $this->arrayToObjectIds($args['users'] ?? []),
            'projects' => $this->arrayToObjectIds($args['projects'] ?? [])
        ]);

        parent::sync($args);
    }
}
