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
class Archive extends ObjectType
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
                        'description' => 'Project\'s _id archive related to'
                    ],
                    'tag' => [
                        'type' => Type::string(),
                        'description' => 'Tag'
                    ],
                    'archive' => [
                        'type' => Type::int(),
                        'description' => 'Count of archived errors'
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
