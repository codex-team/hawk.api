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
    public $project_id;

    /**
     * Project's URI where user take part
     *
     * @var string|null
     */
    public $project_uri;

    /**
     * Contains notifications mode
     *
     * @var array
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
            $this->rawArgs = $args;
            $this->fillModel($args);
        }
    }

    /**
     * Create or Update user
     *
     * @throws \Exception
     */
    public function sync(): void
    {
        $mongoResult = $this->baseSync($this->rawArgs);

        $this->fillModel($mongoResult);
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
