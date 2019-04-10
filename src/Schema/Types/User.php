<?php
declare(strict_types=1);

namespace App\Schema\Types;

use App\Components\Models\User as UserModel;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\{
    ObjectType,
    Type
};

/**
 * Class User
 *
 * @package App\Schema\Types
 */
class User extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    '_id' => [
                        'type' => Type::id(),
                        'description' => 'User\'s unique identifier'
                    ],
                    'email' => [
                        'type' => Type::string(),
                        'description' => 'Email address'
                    ],
                    'password' => [
                        'type' => Type::string(),
                        'description' => 'Password'
                    ],
                    'projects' => [
                        'type' => Type::listOf(TypeRegistry::project()),
                        'description' => 'User\'s projects',
                        'args' => [
                            '_id' => Type::id(),
                            'token' => Type::string(),
                            'name' => Type::string()
                        ],
                        'resolve' => function (UserModel $root, $args) {
                            return $root->projects($args);
                        }
                    ],
                    'membership' => [
                        'type' => Type::listOf(TypeRegistry::membership()),
                        'description' => 'User\'s membership',
                        'args' => [
                            '_id' => Type::id(),
                            'projectId' => Type::string(),
                            'projectUri' => Type::string()
                        ],
                        'resolve' => function (UserModel $root, $args) {
                            return $root->membership($args);
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
