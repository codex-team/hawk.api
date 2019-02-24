<?php

declare(strict_types=1);

namespace App\Schema\Types\Requests;

use App\Components\Models\{Project, Team, User};
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
                        'description' => 'Return User by _id',
                        'args' => [
                            '_id' => Type::nonNull(Type::id()),
                        ],
                        'resolve' => function ($root, $args) {
                            $user = new User();

                            $user->findById($args['_id']);

                            return $user;
                        }
                    ],
                    'project' => [
                        'type' => TypeRegistry::project(),
                        'description' => 'Return Project by _id',
                        'args' => [
                            '_id' => Type::nonNull(Type::id()),
                        ],
                        'resolve' => function ($root, $args) {
                            $user = new Project();

                            $user->findById($args['_id']);

                            return $user;
                        }
                    ],
                    'team' => [
                        'type' => TypeRegistry::team(),
                        'description' => 'Return project\'s Team',
                        'args' => [
                            'projectId' => Type::nonNull(Type::string()),
                            '_id' => Type::id(),
                            'userId' => Type::string()
                        ],
                        'resolve' => function ($root, $args) {
                            $team = new Team($args['projectId']);

                            $team->findOne($args);

                            return $team;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
