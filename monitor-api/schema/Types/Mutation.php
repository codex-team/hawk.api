<?php

namespace App\Schema\Types;

use App\Components\Models\{
    Project,
    Response,
    User
};
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\{
    ObjectType,
    Type
};

/**
 * Class Mutation
 *
 * @package App\Schema\Types
 */
class Mutation extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'user' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Sync User',
                        'args' => [
                            'id' => [
                                'type' => Type::id(),
                                'description' => 'Unique identifier'
                            ],
                            'name' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Login'
                            ],
                            'email' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Email address'
                            ],
                            'password' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Password'
                            ],
                        ],
                        'resolve' => function ($root, $args) {
                            $user = new User($args);

                            $user->sync();

                            return $user;
                        }
                    ],
                    'project' => [
                        'type' => TypeRegistry::project(),
                        'description' => 'Sync Project',
                        'args' => [
                            'id' => [
                                'type' => Type::id(),
                                'description' => 'Unique identifier'
                            ],
                            'name' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Alias name'
                            ],
                            'url' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'URL address'
                            ],
                        ],
                        'resolve' => function ($root, $args) {
                            $project = new Project($args);

                            $project->sync();

                            return $project;
                        }
                    ],
                    'response' => [
                        'type' => TypeRegistry::response(),
                        'description' => 'Sync Response',
                        'args' => [
                            'code' => [
                                'type' => Type::nonNull(Type::int()),
                                'description' => 'HTTP code'
                            ],
                            'time' => [
                                'type' => Type::nonNull(Type::float()),
                                'description' => 'Time in seconds'
                            ],
                            'size' => [
                                'type' => Type::nonNull(Type::int()),
                                'description' => 'Size in bytes'
                            ]
                        ],
                        'resolve' => function ($root, $args) {
                            //добавляем/обновляем ответ
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
