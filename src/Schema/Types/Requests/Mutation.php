<?php
declare(strict_types=1);

namespace App\Schema\Types\Requests;

use App\Components\Base\Mail;
use App\Components\Models\{Membership, Project, Team, User};
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
                    'register' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Register a new user',
                        'args' => [
                            'email' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Email address'
                            ],
                        ],
                        'resolve' => function ($root, $args) {
                            $user = new User();

                            if (User::findOne($args)) {
                                //TODO: как вернуть ошибку??
                                return [];
                            }

                            $password = User::generatePassword(User::DEFAULT_PASSWORD_LENGTH);

                            $args['password'] = $password;

                            if ($user->sync($args)) {
                                Mail::sendViaSMTP(
                                    $args['email'],
                                    'Hello!',
                                    'join.twig',
                                    ['password' => $password]
                                );
                            }

                            return [];
                        }
                    ],
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
                                'type' => Type::nonNull(Type::string()),
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
                            //TODO: uidAdded автоматически
                        ],
                        'resolve' => function ($root, $args) {
                            $project = new Project();

                            $project->sync($args);

                            return $project;
                        }
                    ],
                    'team' => [
                        'type' => TypeRegistry::team(),
                        'description' => 'Sync team',
                        'args' => [
                            'projectId' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Associated project unique identifier'
                            ],
                            '_id' => [
                                'type' => Type::id(),
                                'description' => 'Unique identifier'
                            ],
                            'userId' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Member of project team'
                            ],
                            'role' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Role of team member'
                            ]
                            //TODO: isPending автоматически на true, если не указано иное
                        ],
                        'resolve' => function ($root, $args) {
                            $team = new Team($args['projectId']);

                            unset($args['projectId']);

                            $team->sync($args);

                            return $team;
                        }
                    ],
                    'membership' => [
                        'type' => TypeRegistry::membership(),
                        'description' => 'Sync membership',
                        'args' => [
                            'userId' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Associated user unique identifier'
                            ],
                            '_id' => [
                                'type' => Type::id(),
                                'description' => 'Unique identifier'
                            ],
                            'projectId' => [
                                'type' => Type::nonNull(Type::string()),
                                'description' => 'Project of user membership'
                            ],
                            'projectUri' => [
                                'type' => Type::string(),
                                'description' => 'URI'
                            ],
                            'notifies' => [
                                'type' => Type::listOf(Type::string()),
                                'description' => 'Where to notify'
                            ],
                            'tgHook' => [
                                'type' => Type::string(),
                                'description' => 'Hook for Telegram notifications'
                            ],
                            'slackHook' => [
                                'type' => Type::string(),
                                'description' => 'Hook for Slack notifications'
                            ]
                        ],
                        'resolve' => function ($root, $args) {
                            $membership = new Membership($args['userId']);

                            unset($args['userId']);

                            $membership->sync($args);

                            return $membership;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
