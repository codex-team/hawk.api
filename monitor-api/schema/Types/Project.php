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
                    'id' => [
                        'type' => Type::id(),
                        'description' => 'Project\'s unique identifier'
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Project\'s name'
                    ],
                    'url' => [
                        'type' => Type::string(),
                        'description' => 'Project\'s URL'
                    ],
                    'webhook' => [
                        'type' => Type::string(),
                        'description' => 'Project\'s webhook'
                    ],
                    'responses' => [
                        'type' => Type::listOf(TypeRegistry::response()),
                        'description' => 'Project\'s responses',
                        'resolve' => function ($root, $args) {
                            return [
                                //ответы проекта
                            ];
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
