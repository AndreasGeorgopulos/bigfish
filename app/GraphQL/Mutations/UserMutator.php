<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Models\UserPhone;

class UserMutator
{
    /**
     * @param $root
     * @param array $args
     * @return User
     */
    public function create($root, array $args)
    {
        $model = (new User())->fill($args);
        $model->save();
        $model->phone_numbers()->saveMany(array_map(function ($item) {
            return (new UserPhone())->fill($item);
        }, $args['phone_numbers']));

        return $model;
    }

    /**
     * @param $root
     * @param array $args
     * @return User
     */
    public function update($root, array $args)
    {
        $model = User::findOrFail($args['id'])->fill($args);
        $model->save();
        if (isset($args['phone_numbers']) && is_array($args['phone_numbers'])) {
            $model->phone_numbers()->saveMany(array_map(function ($item) use ($model) {
                return ($model->phone_numbers()->where('phone_number', $item['phone_number'])->firstOrNew())->fill($item);
            }, $args['phone_numbers']));

            $model->phone_numbers()
                ->whereNotIn('phone_number', collect($args['phone_numbers'])->pluck('phone_number')->toArray())
                ->delete();
        }

        return $model;
    }

    /**
     * @param $root
     * @param array $args
     * @return mixed
     */
    public function delete($root, array $args)
    {
        $model = User::findOrFail($args['id']);
        if ($model->phone_numbers()->count()) {
            $model->phone_numbers()->delete();
        }
        $model->delete();

        return $model;
    }
}
