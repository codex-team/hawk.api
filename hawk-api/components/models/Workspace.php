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
     * Image URL
     *
     * @var string|null
     */
    public $image;

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
}