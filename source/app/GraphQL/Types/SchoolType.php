<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\School;

class SchoolType extends GraphQLType
{
    protected $attributes = [
        'name' => 'School',
        'description' => 'A school',
        'model' => School::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The school ID.',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
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
            ],
            'status' => [
                'type' => Type::boolean(),
                'description' => 'If this school is soft deleted.',
            ],
        ];
    }
}
