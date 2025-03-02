<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public  function  index()
    {




        $posts = Post::all();

        return PostResource::collection($posts);

    }

    public  function  store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'published' => 'required|boolean',
            
        ]);
        $validatedData['user_id'] = Auth::user()->id;

        $post = Post::create($validatedData);

        return new PostResource($post);

    }

    public  function  show(Post $post)
    {


        $post = Post::findOrFail($post->id);

       /*  if (Auth::user()->cannot('view', $post)) {
            return response()->json(['message' => 'Forbidden'], 403);

        } */


        return new PostResource($post);



    }

    public  function  update(Request $request, Post $post)
    {

        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'published' => 'required|boolean',
        ]);      
          $validatedData['user_id'] = Auth::user()->id;

        

        $post = Post::findOrFail($post->id);
        $post->update($validatedData);

        return new PostResource($post);

    }

    public  function  destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $post->delete();

        return response()->json(null, 204);

    }

}
