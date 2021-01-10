<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SchoolInputType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SchoolInput',
        'description' => 'The data to create or update a school.'
    ];

    protected $inputObject = true;

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The school ID.',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'max:128'],
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'information' => [
                'type' => Type::string(),
            ],
            'video' => [
                'type' => Type::string(),
            ],
            'active' => [
                'type' => Type::boolean(),
            ]
        ];
    }
}
