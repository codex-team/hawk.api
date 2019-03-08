<?php

namespace App\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class Workspace
 *
 * @package App\Schema\Types
 */
class Workspace extends ObjectType
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
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Workspace title'
                    ],
                    'logo' => [
                        'type' => Type::string(),
                        'description' => 'Logo image URL'
                    ],
                    'users' => [
                        'type' => Type::listOf(Type::string()),
                        'description' => 'Participants IDs'
                    ],
                    'projects' => [
                        'type' => Type::listOf(Type::string()),
                        'description' => 'Projects IDs'
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
