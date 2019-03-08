<?php

declare(strict_types=1);

namespace App\Components\Models;

use MongoDB\BSON\ObjectId;

final class User extends BaseModel
{
    /**
     * Associated collection's name
     *
     * @var string
     */
    protected $collectionName = 'users';

    /**
     * User's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * Email address
     *
     * @var string|null
     */
    public $email;

    /**
     * Password
     *
     * @var string|null
     */
    public $password;

    /**
     * Available workspaces
     *
     * @var array|null
     */
    public $workspaces;

    /**
     * Convert user workspaces before sync
     *
     * @param array $args
     */
    public function sync(array $args): void
    {
        $args = array_merge($args, ['workspaces' => $this->arrayToObjectIds($args['workspaces'] ?? [])]);

        parent::sync($args);
    }

    /**
     * Get user's projects
     *
     * @param array $filter Filter to find records
     *
     * @return array
     */
    public function projects(array $filter = []): array
    {
        $project = new Project();

        $filter = array_merge($filter, ['uidAdded' => new ObjectId($this->_id)]);

        return $project->all($filter);
    }

    /**
     * Get user's membership
     *
     * @param array $filer Filter to find records
     *
     * @return array
     */
    public function membership(array $filer = []): array
    {
        $membership = new Membership($this->_id);

        return $membership->all($filer);
    }
}
