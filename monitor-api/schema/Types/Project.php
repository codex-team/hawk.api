<?php

declare(strict_types=1);

namespace App\Schema\Types;

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
class Project extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    '_id' => [
                        'type' => Type::string(),
                        'description' => 'Project\'s unique identifier'
                    ],
                    'id_added' => [
                        'type' => Type::string(),
                        'description' => 'Owner\'s unique identifier'
                    ],
                    'token' => [
                        'type' => Type::string(),
                        'description' => 'Project public token'
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Project name'
                    ],
                    'description' => [
                        'type' => Type::string(),
                        'description' => 'Project description'
                    ],
                    'domain' => [
                        'type' => Type::string(),
                        'description' => 'Project domain'
                    ],
                    'uri' => [
                        'type' => Type::string(),
                        'description' => 'Project URI'
                    ],
                    'logo' => [
                        'type' => Type::string(),
                        'description' => 'Project logo URL'
                    ],
                    'dt_added' => [
                        'type' => Type::string(),
                        'description' => 'Project creation date'
                    ],
                    'teams' => [
                        'type' => Type::listOf(),
                        'description' => 'Project\'s teams',
                        'resolve' => function ($root, $args) {
                            return [
                                //команды проекта
                            ];
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
