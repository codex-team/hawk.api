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
                            '_id' => [
                                'type' => Type::id(),
                                'description' => 'Unique identifier'
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
                            $user = new User();

                            $user->sync($args);

                            return $user;
                        }
                    ],
                    'project' => [
                        'type' => TypeRegistry::project(),
                        'description' => 'Sync Project',
                        'args' => [
                            '_id' => [
                                'type' => Type::id(),
                                'description' => 'Unique identifier'
                            ],
                            'token' => [
                                'type' => Type::string(),
                                'description' => 'Public token'
                            ],
                            'name' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Name'
                            ],
                            'description' => [
                                'type' => Type::string(),
                                'description' => 'Description'
                            ],
                            'domain' => [
                                'type' => Type::string(),
                                'description' => 'Domain'
                            ],
                            'uri' => [
                                'type' => Type::string(),
                                'description' => 'URI'
                            ],
                            'logo' => [
                                'type' => Type::string(),
                                'description' => 'Logo URL'
                            ],
                            'id_added' => [
                                'type' => Type::string(),
                                'description' => 'Owner\'s unique identifier'
                            ],
                        ],
                        'resolve' => function ($root, $args) {
                            $project = new Project();

                            $project->sync($args);

                            return $project;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
