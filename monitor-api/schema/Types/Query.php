<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\{
    ObjectType,
    Type
};

/**
 * Class Query
 *
 * @package App\Schema\Types
 */
class Query extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'hello' => [
                        'type' => Type::string(),
                        'description' => 'Возвращает приветствие',
                        'resolve' => function () {
                            return 'Привет, GraphQL!';
                        }
                    ],
                    'user' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Return User by id',
                        'args' => [
                            'id' => Type::int()
                        ],
                        'resolve' => function ($root, $args) {
                            return ['name' => 'ada'];
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }

}