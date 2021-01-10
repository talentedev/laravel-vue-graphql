<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\School;
use Auth;

class SaveSchoolMutation extends Mutation
{
    protected $attributes = [
        'name' => 'saveSchool'
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
            'input' => ['name' => 'input', 'type' => GraphQL::type('SchoolInput')],
        ];
    }

    public function resolve($root, $args)
    {
        $input = $args['input'];

        if (isset($input['id'])) {
            $school = School::find($input['id']);
            $school->update($input);
        } else {
            $school = School::create([
                'name' => $input['name'],
                'description' => $input['description'],
                'information' => $input['information'],
                'video' => $input['video'],
                'active' => $input['active']
            ]);
        }

        return $school;
    }
}
