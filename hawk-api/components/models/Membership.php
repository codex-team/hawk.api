<?php

declare(strict_types=1);

namespace App\Components\Models;

use MongoDB\BSON\ObjectId;

final class Membership extends BaseModel
{
    private const COLLECTION_NAME_PATTERN = 'membership:%s';

    /**
     * Membership's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * Project's id where user take part
     *
     * @var string|null
     */
    public $projectId;

    /**
     * Project's URI where user take part
     *
     * @var string|null
     */
    public $projectUri;

    /**
     * Contains notifications mode
     *
     * @var array|null
     */
    public $notifies;

    /**
     * Telegram's hook to notify
     *
     * @var string|null
     */
    public $tgHook;

    /**
     * Slack's hook to notify
     *
     * @var string|null
     */
    public $slackHook;

    /**
     * User._id at collection name, where user takes part
     *
     * @var string
     */
    public $userId;

    /**
     * Membership constructor.
     *
     * @param string $userId Associated user identifier
     * @param array  $args   Values as assoc array to fill model
     */
    public function __construct(string $userId, array $args = [])
    {
        $this->userId = $userId;
        $this->collectionName = sprintf(self::COLLECTION_NAME_PATTERN, $userId);
        parent::__construct($args);
    }

    /**
     * Remove userId and convert projectId to ObjectId before sync
     *
     * @param array $args
     */
    public function sync(array $args): void
    {
        $args['projectId'] = new ObjectId($args['projectId']);

        parent::sync($args);
    }

    /**
     * Get membership from collection
     *
     * @param array $filter Filter to find records
     *
     * @return array
     */
    public function all(array $filter = []): array
    {
        if (array_key_exists('_id', $filter)) {
            $filter['_id'] = new ObjectId($filter['_id']);
        }

        if (array_key_exists('projectId', $filter)) {
            $filter['projectId'] = new ObjectId($filter['projectId']);
        }

        $cursor = $this->assocCollection()->find($filter);

        $result = [];

        foreach ($cursor as $value) {
            $result[] = new static($this->userId, $value);
        }

        return $result;
    }

    /**
     * Get Project model
     *
     * @return User
     */
    public function project(): Project
    {
        $project = new Project();

        $project->findById($this->projectId);

        return $project;
    }
}
