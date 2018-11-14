<?php

namespace App\Schema\Types;

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
                        'type' => Type::string(),
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
