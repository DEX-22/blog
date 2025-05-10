<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::getOwns();

        return Inertia::render('MisPosts/Index',[
            "posts"=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visibility = Post::VISIBILITY;
        $post = new Post();
    
        return Inertia::render('MisPosts/Create',[
            "visibility"=>$visibility,
            "post" => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        
        $post = new Post([
            "title" => $request["title"],
            "content" => $request["content"],
            "visibility" => Post::PUBLIC,
            "created_by" => Auth::id()
        ]);

        $post->save();

        return response()->redirectTo(route('mis-posts'))->with('success',$post->title);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
