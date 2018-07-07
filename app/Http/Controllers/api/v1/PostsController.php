<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Requests;
use phpDocumentor\Reflection\Types\Integer;

class PostsController extends Controller
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
        $user = Auth()->user();
        $post =  new Post;

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = $user->id;
        $post->cover_image = 'noimage.jpg'; //$request->input() ko through lyaunu parchha pachhi

        if ($post->save()){
            return new PostResource($post);
        } else{
            return response(
                ["error"=>"true"]
            );
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
        $user = Auth()->user();
        // dd($post->user_id);
        if($post->user_id == $user->id){
            return response()->json(['error'=>'False', 
            'message'=>'Get Specific post of user successful',
             'data' => new PostResource($post)]); //return single post as post resource
        } else{
            return response()->json(['error'=>'True', 
            'message'=>'This post does not belong to this user']); 
        }
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
        $post = Post::findorFail($id);


        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        $post->cover_image = 'noimage.jpg'; //$request->input() ko through lyaunu parchha pachhi
        $post->updated_at = time();

        if ($post->save()){
            return new PostResource($post);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::findorFail($id);
        //$status = "Deleted";

        if ($post->delete()){
            //return $status;
            return new PostResource($post);
        }

    }
}
