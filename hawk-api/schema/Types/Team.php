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
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
