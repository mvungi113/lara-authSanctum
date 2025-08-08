<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Post::with('user')->latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = $request->user()->posts()->create($request->only('title', 'body'));

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return response()->json($post);
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
    public function update(Request $request, Post $post)
    {
        //
        $request -> validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $post -> update($request ->only('title', 'body'));
        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //

        $post ->delete();
        return response()->json(['message' => 'Post deleted successfully']);    
    }
}
