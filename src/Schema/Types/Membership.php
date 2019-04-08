<?php

declare(strict_types=1);

namespace App\Schema\Types;

use App\Components\Models\Membership as MembershipModel;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\{
    ObjectType,
    Type
};

/**
 * Class Project
 *
 * @package App\Schema\Types
 */
class Membership extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    '_id' => [
                        'type' => Type::id(),
                        'description' => 'Unique identifier'
                    ],
                    'projectId' => [
                        'type' => Type::string(),
                        'description' => 'Project\'s id where user take part'
                    ],
                    'projectUri' => [
                        'type' => Type::string(),
                        'description' => 'Project\'s URI where user take part'
                    ],
                    'notifies' => [
                        'type' => Type::listOf(Type::boolean()),
                        'description' => 'Contains notifications mode'
                    ],
                    'tgHook' => [
                        'type' => Type::string(),
                        'description' => 'Telegram\'s hook to notify'
                    ],
                    'slackHook' => [
                        'type' => Type::string(),
                        'description' => 'Slack\'s hook to notify'
                    ],
                    'project' => [
                        'type' => TypeRegistry::project(),
                        'description' => 'Participant model',
                        'resolve' => function (MembershipModel $root, $args) {
                            return $root->project();
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
