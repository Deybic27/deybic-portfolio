<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Post_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image;
        $post->post_category_id = $request->category;
        $post->user_id = Auth::user()->id;
        $post->save();
        
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('post-categories.index')->with('success','Publicación creada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'id' => $post->id,
            'title' => $post['title'],
            'description' => $post['description'],
            'post_category_id' => $post['post_category_id'],
            'created_at' => $post['created_at'],
            'author' => User::find($post->user_id)->name,
            'media' => $post->getMedia('image')->first()
        ];
        $header = [];
        $categories = Post_category::all();
        foreach ($categories as $key => $category) {
            $header[] = [
                "category" => $category,
                "posts" => $category->posts()->getResults()
            ];
        }
        // dd($header);
        return view('blog.app',["post" => $data, "headers" => $header]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::find($post->id);

        
        $post->title = $request->title ?? $post->title;
        $post->description = $request->description ?? $post->description;
        $post->image = $request->image ?? $post->image;
        $post->post_category_id = $request->category ?? $post->post_category_id;
        $post->save();
        
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->clearMediaCollection('image');
            $post->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('post-categories.index')->with('success','Publicación actualizada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post-categories.index')->with('success','Publicación eliminada correctamente');
    }
}
