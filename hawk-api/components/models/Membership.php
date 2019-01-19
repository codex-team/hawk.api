<?php

declare(strict_types=1);

namespace App\Components\Models;

class Membership extends BaseModel
{
    // TODO: разобраться с "collection:<user._id>"
    protected const COLLECTION_NAME = '';

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
     * User constructor.
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
     * Create or Update membership
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
     * Return collection name
     *
     * @return string
     */
    public function collectionName(): string
    {
        return self::COLLECTION_NAME;
    }
}
