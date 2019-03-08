<?php

declare(strict_types=1);

namespace App\Components\Models;

final class Team extends BaseModel
{
    private const COLLECTION_NAME_PATTERN = 'team:%s';

    /**
     * Membership's unique identifier
     *
     * @var string|null
     */
    public $_id;

    /**
     * User's id which take part
     *
     * @var string|null
     */
    public $userId;

    /**
     * Role type
     *
     * @var string|null
     */
    public $role;

    /**
     * Pending status
     *
     * @var bool|null
     */
    public $isPending;

    /**
     * Project._id at collection name, that team belongs to
     *
     * @var string
     */
    public $projectId;

    /**
     * Team constructor.
     *
     * @param string $projectId Associated project identifier
     * @param array  $args      Values as assoc array to fill model
     */
    public function __construct(string $projectId, array $args = [])
    {
        $this->projectId = $projectId;
        $this->collectionName = sprintf(self::COLLECTION_NAME_PATTERN, $projectId);
        parent::__construct($args);
    }

    /**
     * Remove projectId and convert userId to ObjectId before sync
     *
     * @param array $args Values as assoc array to sync model
     */
    public function sync(array $args): void
    {
        $this->arrayValuesToObjectId($args, 'userId');
        parent::sync($args);
    }

    /**
     * Get team participants from collection
     *
     * @param array $filter Filter to find records
     *
     * @return array
     */
    public function all(array $filter = []): array
    {
        $this->arrayValuesToObjectId($filter, '_id', 'userId');

        $cursor = $this->assocCollection()->find($filter);

        $result = [];

        foreach ($cursor as $value) {
            $result[] = new static($this->projectId, $value);
        }

        return $result;
    }

    /**
     * Get Participant model
     *
     * @return User
     */
    public function user(): User
    {
        $user = new User();

        $user->findById($this->userId);

        return $user;
    }
}
