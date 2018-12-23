<?php

declare(strict_types=1);

namespace App\Schema\Types\Requests;

use App\Components\Models\{
    Project,
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
                                'type' => Type::string(),
                                'description' => 'Alias name'
                            ],
                            'url' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'URL address'
                            ],
                            'webhooks' => [
                                'type' => Type::listOf(Type::string()),
                                'description' => 'Webhook URL'
                            ],
                        ],
                        'resolve' => function ($root, $args) {
                            $project = new Project($args);

                            $project->sync();

                            return $project;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
