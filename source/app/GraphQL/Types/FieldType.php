<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Field;

class FieldType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Field',
        'description' => 'A training field',
        'model' => Field::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The field ID.',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'status' => [
                'type' => Type::boolean(),
                'description' => 'If this field is soft deleted.',
            ],
        ];
    }
}
