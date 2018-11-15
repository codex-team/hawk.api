<?php

namespace App\Schema\Types;

use GraphQL\Type\Definition\{
    ObjectType,
    Type
};

/**
 * Class Response
 *
 * @package App\Schema\Types
 */
class Response extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'code' => [
                        'type' => Type::int(),
                        'description' => 'Response\'s code'
                    ],
                    'time' => [
                        'type' => Type::float(),
                        'description' => 'Response\'s time'
                    ],
                    'size' => [
                        'type' => Type::int(),
                        'description' => 'Response\'s size'
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
