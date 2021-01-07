<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\User;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A user.',
        'model' => User::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The user ID.',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The user email.',
            ],
            'nom' => [
                'type' => Type::string(),
            ],
            'prenom' => [
                'type' => Type::string(),
            ],
            'gender' => [
                'type' => Type::int(),
            ],
            'birthday' => [
                'type' => Type::string(),
            ],
            'telephone' => [
                'type' => Type::string(),
            ],
            'nationality' => [
                'type' => Type::string(),
            ]
        ];
    }
}
