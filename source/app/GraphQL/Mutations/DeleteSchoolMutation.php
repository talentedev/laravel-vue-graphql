<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\School;
use Auth;

class DeleteSchoolMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteSchool'
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
        return GraphQL::type('School');
    }

    public function args() : array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args)
    {
        $school = School::withTrashed()->find($args['id']);

        $school->delete();

        return ['status' => $school->trashed()];
    }
}
