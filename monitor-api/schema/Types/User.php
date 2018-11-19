<?php

declare(strict_types=1);

namespace App\Schema\Types;

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
                    'id' => [
                        'type' => Type::id(),
                        'description' => 'User\'s unique identifier'
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'User\'s name'
                    ],
                    'email' => [
                        'type' => Type::string(),
                        'description' => 'User\'s email'
                    ],
                    'password' => [
                        'type' => Type::string(),
                        'description' => 'User\'s password'
                    ],
                    'projects' => [
                        'type' => Type::listOf(TypeRegistry::project()),
                        'description' => 'User\'s projects',
                        'resolve' => function ($root, $args) {
                            return [
                                //проекты пользователей
                            ];
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
