<?php

namespace App\Transformers;

use App\Distro;
use League\Fractal;

class DistroTransformer extends Fractal\TransformerAbstract
{
    public function transform(Distro $distro)
    {
        return [
            "id" => (int) $distro->id,
            "name" => $distro->name,
            "description" => $distro->description,
            "created_at" => $distro->created_at->format("dd-mm-Y"),
            "updated_at" => $distro->updated_at->format("dd-mm-Y"),
        ];
    }
}
