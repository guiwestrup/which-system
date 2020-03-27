<?php

namespace App\Transformers;

use App\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            "id" => (int) $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "admin" => $user->admin,
            "created_at" => $user->created_at->format("dd-mm-Y"),
            "updated_at" => $user->updated_at->format("dd-mm-Y"),
        ];
    }
}
