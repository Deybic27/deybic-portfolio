<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post_category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        // Data validation
        $rules = [
            'title' => [
                "required",
                "unique:posts,title",
                "min:3",
                "max:50",
            ],
            'description' => [
                "required"
            ],
            'image' => [
                "required",
                "max:1000",
                "dimensions:max_width=1080,max_height=1080"
            ],
            'category' => [
                "required",
                "exists:App\Models\Post_category,id"
            ],
        ];
        $message = [
            'title.required' => 'El título es obligatorio',
            'title.unique' => 'Ya existe una publicación con ese nombre',
            "title.min" => "El título debe tener como mínimo :min dígitos",
            "title.max" => "El título debe tener como máximo :max dígitos",
            'description.required' => 'La descripción es obligatoria',
            'image.required' => 'La imagen es obligatoria',
            'image.dimensions' => 'Las dimensiones de la imagen deben ser máximo :max_width x :max_height',
            'image.max' => 'La imagen debe ser máximo :max kilobytes',
            'category.required' => 'La categoría es obligatoria',
            'category.exists' => 'La categoría seleccionada no es válida.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        
        if ($validator->fails()) {    
            // Estos datos se envían
            $str = "title=" . urlencode($request->get("title")) . "\n";
            $str .= "description=" . urlencode($request->get("description")) . "\n";
            $str .= "post_category_id=" . $request->get("category");
            $strEncode = urlencode(base64_encode($str));

            return redirect("/post-categories#&p=new&d=$strEncode")
                    ->withErrors($validator)
                    ->withInput();
        }
        $this->validate($request, $rules, $message);

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
        // Data validation
        $rules = [
            'title' => [
                "required",
                "unique:posts,title,$post->id",
                "min:3",
                "max:50"
            ],
            'description' => [
                "required"
            ],
            'image' => [
                "max:1000",
                "dimensions:max_width=1080,max_height=1080"
            ],
            'category' => [
                "required",
                "exists:post_categories,id"
            ],
        ];
        $message = [
            'title.required' => 'El título es obligatorio',
            'title.unique' => 'Ya existe una publicación con ese nombre',
            "title.min" => "El título debe tener como mínimo :min dígitos",
            "title.max" => "El título debe tener como máximo :max dígitos",
            'description.required' => 'La descripción es obligatoria',
            'image.required' => 'La imagen es obligatoria',
            'image.dimensions' => 'Las dimensiones de la imagen deben ser máximo :max_width x :max_height',
            'image.max' => 'La imagen debe ser máximo :max kilobytes',
            'category.required' => 'La categoría es obligatoria',
            'category.exists' => 'La categoría seleccionada no es válida.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $post = Post::find($post->id);
        
        if ($validator->fails()) {
            $urlImage = $post->getMedia('image')->first()->getUrl() ?? "";
    
            // Estos datos se envían
            $str = "title=" . urlencode($request->get("title")) . "\n";
            $str .= "description=" . urlencode($request->get("description")) . "\n";
            $str .= "post_category_id=" . $request->get("category") . "\n";
            $str .= "id=" . $post->id . "\n";
            $str .= "urlImage=" . $urlImage;
            $strEncode = urlencode(base64_encode($str));

            return redirect("/post-categories#&p=$post->id&d=$strEncode")
                    ->withErrors($validator)
                    ->withInput();
        }
        $this->validate($request, $rules, $message);
        
        // Data save
        $post->title = $request->title;
        $post->description = $request->description;
        if ($request->image) {
            $post->image = $request->image;
        }
        $post->post_category_id = $request->category;
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
