<?php

declare(strict_types=1);

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\{
    ObjectType,
    Type
};
use App\Components\Models\Team as TeamModel;

/**
 * Class Project
 *
 * @package App\Schema\Types
 */
class Team extends ObjectType
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
                    'userId' => [
                        'type' => Type::string(),
                        'description' => 'User\'s id which take part'
                    ],
                    'role' => [
                        'type' => Type::string(),
                        'description' => 'Role type'
                    ],
                    'isPending' => [
                        'type' => Type::string(),
                        'description' => 'Pending status'
                    ],
                    'user' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Participant model',
                        'resolve' => function (TeamModel $root, $args) {
                            return $root->user();
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
