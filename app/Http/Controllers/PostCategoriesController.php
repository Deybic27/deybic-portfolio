<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post_category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Post_category::all();

        return view('admin-posts', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => [
                "required",
                "unique:post_categories,name",
                "min:3"
                ]
        ];
        $message = [
            "name.required" => "El nombre es obligatorio",
            'name.unique' => 'Ya existe una categoría con ese nombre',
            "name.min" => "El nombre debe tener como mínimo :min dígitos"
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect("/post-categories#&c=new")
                    ->withErrors($validator)
                    ->withInput();
        }

        $postCategory = new Post_category;
        $postCategory->name = $request->name;
        $postCategory->user_id = Auth::user()->id;
        $postCategory->save();

        return redirect()->route('post-categories.index')->with('success','Categoría creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function show(Post_category $post_category)
    {
        $postCategory = Post_category::find($post_category);
        return view('post-categories.show', ['category' => $postCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Post_category $post_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post_category $post_category)
    {
        $rules = [
            "name" => [
                "required",
                "unique:post_categories,name,$post_category->id",
                "min:3",
                "max:50",
            ]
        ];
        $message = [
            "name.required" => "El nombre es obligatorio",
            "name.unique" => "Ya existe una categoría con este nombre",
            "name.min" => "El nombre debe tener como mínimo :min dígitos",
            "name.max" => "El nombre debe tener como máximo :max dígitos"
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect("/post-categories#&c=$post_category->id")
                    ->withErrors($validator)
                    ->withInput();
        }

        $post_category->name = $request->name;
        $post_category->save();
        return redirect()->route('post-categories.index')->with('success','Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post_category $post_category)
    {
        $post_category->posts()->each(function($post){
            $post->delete();
        });
        $post_category->delete();
        return redirect()->route('post-categories.index')->with('success','Categoría eliminada correctamente');

    }
}
