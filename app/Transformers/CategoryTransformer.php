<?php

namespace App\Transformers;

use App\Category;
use League\Fractal;

class CategoryTransformer extends Fractal\TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            "id" => (int) $category->id,
            "name" => $category->name,
            "description" => $category->description,
            "image_path" => $category->image_path,
            "icon_path" => $category->icon_path,
            "created_at" => $category->created_at->format("dd-mm-Y"),
            "updated_at" => $category->updated_at->format("dd-mm-Y"),
        ];
    }
}
