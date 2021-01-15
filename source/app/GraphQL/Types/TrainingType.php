<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Training;

class TrainingType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Training',
        'description' => 'A training course',
        'model' => Training::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The field ID.',
            ],
            'label' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::boolean(),
                'description' => 'If this field is soft deleted.',
            ],
        ];
    }
}
