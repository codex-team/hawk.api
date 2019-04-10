<?php
declare(strict_types=1);

namespace App\Components\Models;

use MongoDB\BSON\UTCDateTime;

final class Project extends BaseModel
{
    /**
     * Associated collection's name
     *
     * @var string
     */
    protected $collectionName = 'projects';

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
     * Project's website
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
    public $uidAdded;

    /**
     * Added date
     *
     * @var string|null
     */
    public $dtAdded;

    /**
     * Add dtAdded value before save
     *
     * @param array $args
     *
     * @return array
     */
    protected function save(array $args): array
    {
        $args['dtAdded'] = new UTCDateTime();

        return parent::save($args);
    }

    /**
     * Get author model
     *
     * @return User
     */
    public function user(): User
    {
        $user = new User();

        $user->findById($this->uidAdded);

        return $user;
    }

    /**
     * Get project team
     *
     * @param array $filter
     *
     * @return array
     */
    public function team(array $filter = []): array
    {
        $team = new Team($this->_id);

        return $team->all($filter);
    }
}
