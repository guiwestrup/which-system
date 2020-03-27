<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Store a new tag.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:posts|max:255',
            'description' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg|max:1024',
            'icon'  =>  'required|file|mimes:jpg,jpeg|max:1024',
        ]); 
        
        if ($validator->fails()) {
            return response()->json()->withErrors($validatedData);
        }
        
        $image = $request->file('image')->store('tag/images', 'public');        
        $icon = $request->file('icon')->store('tag/icons', 'public');        
        

        Tag::create([
            'name' => $validatedData->name,
            'description'  =>  $validatedData->description,
            'image_path'   =>  $image,
            'icon_path'    =>  $icon 
        
        return response()->json($validatedData);

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
/
}
