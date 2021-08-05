<?php

namespace App\GraphQL\Queries;

use App\Models\User;

class UserQuery
{
    /**
     * @param $root
     * @param array $args
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($root, array $args)
    {
        return User::orderBy($args['orderBy'][0]['column'], $args['orderBy'][0]['order'])
            ->paginate($args['items_per_page'], ['*'], 'page', $args['page']);
    }
}
