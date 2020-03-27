<?php

namespace App\Transformers;

use App\Image;
use Illuminate\Support\Facades\App;
use League\Fractal;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        "distro",
    ];

    public function transform(Image $image)
    {
        return [
            "id" => (int) $image->id,
            "order" => (int) $image->order,
            "path" => $image->path,
            "created_at" => $image->created_at->format("dd-mm-Y"),
            "updated_at" => $image->updated_at->format("dd-mm-Y"),
        ];
    }


    public function includeDistro(Image $image, ParamBag $paramBag)
    {
        return $this->item($image->distro, App::make(DistroTransformer::class));

        list($orderCol, $orderCol) = $paramBag->get('order') ?: ['created_at', 'desc'];

        $distros = $image->distro()->orderBy($orderCol, $orderBy)->get();

        return $this->collection($distros, App::make(DistroTransformer::class));
    }

}

