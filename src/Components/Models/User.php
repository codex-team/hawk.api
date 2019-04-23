<?php
declare(strict_types=1);

namespace App\Components\Models;

final class User extends BaseModel
{
    public const DEFAULT_PASSWORD_LENGTH = 10;

    /**
     * Associated collection's name
     *
     * @var string
     */
    protected static $collectionName = 'users';

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
     * Generate random password
     *
     * @param int $length
     *
     * @return string
     */
    public static function generatePassword(int $length): string
    {
        return bin2hex(openssl_random_pseudo_bytes( $length / 2));
    }

    /**
     * Get user's projects
     *
     * @param $filter
     *
     * @return array
     */
    public function projects(array $filter = []): array
    {
        $project = new Project();

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
