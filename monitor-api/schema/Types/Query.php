<?php

declare(strict_types=1);

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
 * Class Query
 *
 * @package App\Schema\Types
 */
class Query extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'user' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Return User by id',
                        'args' => [
                            'id' => Type::nonNull(Type::id()),
                        ],
                        'resolve' => function ($root, $args) {
                            $user = new User();

                            $user->findOne($args['id']);

                            return $user;
                        }
                    ],
                    'project' => [
                        'type' => TypeRegistry::project(),
                        'description' => 'Return projects',
                        'resolve' => function ($root, $args) {
                            return [
                                //поля проекта
                            ];
                        }
                    ],
                    'projects' => [
                        'type' => Type::listOf(TypeRegistry::project()),
                        'description' => 'Return all projects',
                        'resolve' => function ($root, $args) {
                            $projects = new Project();

                            return $projects->all();
                        }
                    ],
                    'response' => [
                        'type' => TypeRegistry::response(),
                        'description' => 'Return response of request to project URL',
                        'resolve' => function ($root, $args) {
                            return [
                                //поля ответа
                            ];
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
