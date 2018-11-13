<?php

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
            'fields' => [
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
                'responses' => [
                    'type' => Type::listOf(TypeRegistry::response()),
                    'description' => 'Project\'s responses'
                ],
            ]
        ];

        parent::__construct($config);
    }
}
