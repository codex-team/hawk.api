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
                    'user' => [
                        'type' => TypeRegistry::user(),
                        'description' => 'Return User by id',
                        'args' => [
                            'id' => Type::nonNull(Type::id()),
                        ],
                        'resolve' => function ($root, $args) {
                            return [
                                //поля пользователя
                            ];
                        }
                    ],
                    'project' => [
                        'type' => TypeRegistry::project(),
                        'description' => 'Return projects',
                        'resolve' => function ($root, $args) {
                            return [
                                //поля проекта
                            ];
                        }
                    ],
                    'response' => [
                        'type' => TypeRegistry::response(),
                        'description' => 'Return response\'s data',
                        'resolve' => function ($root, $args) {
                            return [
                                //поля ответа
                            ];
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
