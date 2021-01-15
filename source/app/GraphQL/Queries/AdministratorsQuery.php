<?php

namespace App\GraphQL\Queries;

use GraphQL;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Auth;

class AdministratorsQuery extends Query
{
    protected $attributes = [
        'name' => 'adminitrators'
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
        return Type::listOf(GraphQL::type('User'));
    }

    public function args() : array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'nom' => ['name' => 'nom', 'type' => Type::string()],
            'prenom' => ['name' => 'prenom', 'type' => Type::string()],
            'role' => ['name' => 'role', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, SelectFields $fields)
    {
        $users = User::select($fields->getSelect());
        return $users->whereIn('role', ['super admin', 'school admin'])->get();
    }
}
