<?php

namespace App\Transformers;

use App\Vote;
use Illuminate\Support\Facades\App;
use League\Fractal;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

class VoteTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        "distro",
        "user",
    ];

    public function transform(Vote $vote)
    {
        return [
            "id" => (int) $vote->id,
            "name" => $vote->name,
            "value" => (float) $vote->value,
            "created_at" => $vote->created_at->format("dd-mm-Y"),
            "updated_at" => $vote->updated_at->format("dd-mm-Y"),
        ];
    }

    public function includeUsers(Vote $vote, ParamBag $paramBag)
    {
        list($orderCol, $orderBy) = $paramBag->get('order') ?: ['created_at', 'desc'];

        $users = $vote->users()->orderBy($orderCol, $orderBy)->get();

        return $this->collection($users, App::make(UserTransformer::class)); 
    }

    public function includeDistro(Vote $vote, ParamBag $paramBag)
    {
        list($orderCol, $orderCol) = $paramBag->get('order') ?: ['created_at', 'desc'];

        $distros = $vote->distro()->orderBy($orderCol, $orderBy)->get();

        return $this->collection($distros, App::make(UserTransformer::class));
    }

}
