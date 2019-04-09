<?php
declare(strict_types=1);

namespace App\Schema\Types\Requests;

use App\Components\Models\{Membership, Project, Team, User};
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
                        'description' => 'Get User by _id',
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
                        'description' => 'Get Project by _id',
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
                        'type' => Type::listOf(TypeRegistry::team()),
                        'description' => 'Get project\'s Team',
                        'args' => [
                            'projectId' => Type::nonNull(Type::string()),
                            '_id' => Type::id(),
                            'userId' => Type::string()
                        ],
                        'resolve' => function ($root, $args) {
                            $team = new Team($args['projectId']);

                            unset($args['projectId']);

                            return $team->all($args);
                        }
                    ],
                    'membership' => [
                        'type' => Type::listOf(TypeRegistry::membership()),
                        'description' => 'Get user\'s Membership',
                        'args' => [
                            'userId' => Type::nonNull(Type::string()),
                            '_id' => Type::id(),
                            'projectId' => Type::string(),
                            'projectUri' => Type::string()
                        ],
                        'resolve' => function ($root, $args) {
                            $membership = new Membership($args['userId']);

                            unset($args['userId']);

                            return $membership->all($args);
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
