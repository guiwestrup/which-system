<?php

namespace App\Transformers;

use App\Tag;
use League\Fractal;

class TagTransformer extends Fractal\TransformerAbstract
{
    public function transform(Tag $tag)
    {
        return [
            "id" => (int) $tag->id,
            "name" => $tag->name,
            "description" => $tag->description,
            "image_path" => $tag->image_path,
            "icon_path" => $tag->icon_path,
            "created_at" => $tag->created_at->format("dd-mm-Y"),
            "updated_at" => $tag->updated_at->format("dd-mm-Y"),
        ];
    }
}
