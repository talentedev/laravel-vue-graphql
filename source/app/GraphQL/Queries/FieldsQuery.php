<?php

namespace App\GraphQL\Queries;

use GraphQL;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Field;
use Auth;

class FieldsQuery extends Query
{
    protected $attributes = [
        'name' => 'fields'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null) : bool
    {
        $user = Auth::user();

        if (empty($user)) {
            return false;
        }

        return true;
    }

    public function type() : Type
    {
        return Type::listOf(GraphQL::type('Field'));
    }

    public function args() : array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, SelectFields $fields)
    {
        $trainingFields = Field::select($fields->getSelect());
        return $trainingFields->get();
    }
}
