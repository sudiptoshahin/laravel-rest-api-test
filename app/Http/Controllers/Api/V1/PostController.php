<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePostRequest;
use App\Http\Resources\V1\PostResource;
use App\Http\Requests\V1\UpdatePostRequest;
use App\Http\Resources\V1\PostCollection;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $includeComments = $request->query('includeComments');

        $posts = Post::where([]);
        if($includeComments) {
            $posts = $posts->with('comments');
        }

        return new PostCollection($posts->paginate()->appends($request->query()));
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
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //  create new post
        return new PostResource(Post::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
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
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $result = $post->update($request->all());
        if($result) {
            return [
                'message' => "Updated successfully!"
            ];
        } else {
            return [
                'error' => "Cannot updated!"
            ];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
