<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post_category;
use Illuminate\Http\Request;

class PostsCategoriesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function show(Post_category $post_category)
    {
        return $post_category;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post_category $post_category)
    {
        //
    }
}
