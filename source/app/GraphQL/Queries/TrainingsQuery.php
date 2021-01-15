<?php

namespace App\GraphQL\Queries;

use GraphQL;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Training;
use Auth;

class TrainingsQuery extends Query
{
    protected $attributes = [
        'name' => 'trainings'
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
        return Type::listOf(GraphQL::type('Training'));
    }

    public function args() : array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'label' => ['name' => 'label', 'type' => Type::string()],
            'school_id' => ['name' => 'school_id', 'type' => Type::int()],
            'field_id' => ['name' => 'field_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, SelectFields $fields)
    {
        $trainings = Training::select($fields->getSelect());
        return $trainings
                    ->where('school_id', $args['school_id'])
                    ->get();
    }
}
