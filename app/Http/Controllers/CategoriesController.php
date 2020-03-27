<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();
    }

    public function show($id)
    {
        $category = Category::find($id);
        $resource = new Item($category, new CategoryTransformer);

        return $this->fractal->createData($resource)->toJson();
    }


    /**
     * Store a new category.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request ,[
            'name' => 'required|unique:posts|max:255',
            'description' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg|max:1024',
            'icon'  =>  'required|file|mimes:jpg,jpeg|max:1024',
        ]); 
        
        $image = $request->file('image')->store('category/images', 'public');        
        $icon = $request->file('icon')->store('category/icons', 'public');        
        

        $category = Category::create([
            'name' => $validatedData->name,
            'description'  =>  $validatedData->description,
            'image_path'   =>  $image,
            'icon_path'    =>  $icon 
        ]);
        
        return response()->json('Cadastro efetuado com sucesso', 201);

    }
    
    /**
     * Update the given category.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return json
     */
    public function update(Request $request, $id)
    {
        //
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
    
}
