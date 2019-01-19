<?php

declare(strict_types=1);

namespace App\Schema\Types;

use GraphQL\Type\Definition\{
    ObjectType,
    Type
};

/**
 * Class Project
 *
 * @package App\Schema\Types
 */
class Project extends ObjectType
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
                    'token' => [
                        'type' => Type::string(),
                        'description' => 'Public token'
                    ],
                    'name' => [
                        'type' => Type::string(),
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
                    'uidAdded' => [
                        'type' => Type::string(),
                        'description' => 'Owner\'s unique identifier'
                    ],
                    'dtAdded' => [
                        'type' => Type::string(),
                        'description' => 'Creation date'
                    ],
//                    'teams' => [
//                        'type' => Type::listOf(),
//                        'description' => 'Project\'s teams',
//                        'resolve' => function ($root, $args) {
//                            return [
//                                //команды проекта
//                            ];
//                        }
//                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
