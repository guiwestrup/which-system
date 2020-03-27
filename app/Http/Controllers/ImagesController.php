<?php

namespace App\Http\Controllers;

use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\ImageTransformer;

class ImagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $fractal;

    /**
     * @var ImageTransformer
     */
    private $imageTransformer;

    public function __construct(Manager $fractal, ImageTransformer $imageTransformer)
    {
        $this->fractal = $fractal;
        $this->imageTransformer = $imageTransformer;
    }

    public function index(Request $request)
    {
        $imagesPaginator = Image::paginate(10);
        
        $images = new Collection($imagesPaginator->items(), $this->imageTransformer);
        $images->setPaginator(new IlluminatePaginatorAdapter($imagesPaginator));

        $this->fractal->parseIncludes($request->get('include', ''));

        $images = $this->fractal->createData($images);

        return $images->toJson();
    }

    public function show($id)
    {
        $image = Image::find($id);

        return $image;
    }
}
