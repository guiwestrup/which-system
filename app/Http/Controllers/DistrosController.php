<?php

namespace App\Http\Controllers;

use App\Distro;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\DistroTransformer;

class DistrosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $fractal;

    /**
     * @var DistroTransformer
     */
    private $distroTransformer;

    public function __construct(Manager $fractal, DistroTransformer $distroTransformer)
    {
        $this->fractal = $fractal;
        $this->distroTransformer = $distroTransformer;
    }

    public function index(Request $request)
    {
        $distrosPaginator = Distro::paginate(10);
        
        $distros = new Collection($distrosPaginator->items(), $this->distroTransformer);
        $distros->setPaginator(new IlluminatePaginatorAdapter($distrosPaginator));

        $this->fractal->parseIncludes($request->get('include', ''));

        $distros = $this->fractal->createData($distros);

        return $distros->toJson();
    }

    public function show($id)
    {
        $distro = Distro::find($id);
        $resource = new Item($distro, new DistroTransformer);

        return $this->fractal->createData($resource)->toJson();
    }

    /**
     * Store a new distro.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
            'name' => 'required|unique:distros|max:255',
            'description' => 'required',
        ]);
        
        $distro = Distro::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $resource = new Item($distro, new DistroTransformer);

        return $this->fractal->createData($resource)->toArray();
        
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:distros|max:255',
            'description' => 'required',
        ]);

        if(!Distro::find($id)) return $this->customResponse('distro not found!', 404);

        $distro = Distro::find($id)->update($request->all());

        if($distro){
            $resource = new Item(Distro::find($id), new DistroTransformer);
            return $this->fractal->createData($resource)->toArray();
        }

        return $this->errorResponse('Failed to update distro!', 400);
    }

    public function destroy($id)
    {
        if(!Distro::find($id)) return $this->customResponse('Distro not found!', 404);

        if(Distro::find($id)->delete()){
            return $this->customResponse('Distro deleted successfully!', 410);
        }

        return $this->customResponse('Failed to delete distro!', 400);
    }

    public function customResponse($message = 'success', $status = 200)
    {
        return response([
            'status' =>  $status, 
            'message' => $message
        ],$status);
    }
 
}
