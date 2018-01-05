<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Http\Resources\Post as PostResource;

use App\Http\Requests;
use phpDocumentor\Reflection\Types\Integer;

class PostsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); //paginate with 10 posts per page
        return PostResource::collection($posts);
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
        $post = $request->isMethod('put') ? Post::findorFail
        ($request->post_id) : new Post;

        $post->id = $request->input('post_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if ($post->save()){
            return new PostResource($post);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get a single post
        $post = Post::findorFail($id);

        //return single post as post resource
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get a single post
        //$status_code = new Integer();
        $post = Post::findorFail($id);

        if ($post->delete()){
            return new PostResource($post);
        } else{
//            $status_code = 900; //fail
//            return $status_code;
        }

    }
}
