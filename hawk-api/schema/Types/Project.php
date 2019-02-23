<?php

declare(strict_types=1);

namespace App\Schema\Types;

use App\Components\Models\{
    Project as ProjectModel,
};
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
                    'user' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Project\'s owner',
                        'resolve' => function (ProjectModel $root, $args) {
                            return $root->user();
                        }
                    ],
                    'team' => [
                        'type' => Type::listOf(TypeRegistry::team()),
                        'description' => 'Project\'s teams',
                        'resolve' => function (ProjectModel $root, $args) {
                            return $root->team($args);
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
