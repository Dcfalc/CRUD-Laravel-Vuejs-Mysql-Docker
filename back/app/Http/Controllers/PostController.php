<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::get();
        $posts = DB::table('posts')
            ->select(DB::raw('id, author, title, SUBSTRING(text,1, 100) AS text'))
            ->get();

        if ( empty($posts) ){
            return response()->json(null,204);
        }
        
        return response()->json(compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author'  => 'required|string|min:3|max:100',
            'title'  => 'required|string|min:5|max:100',
            'text'  => 'required|string|min:10|max:255',
            'email' => 'required|email|string|min:6|max:100', // |unique:posts
            'phone' => 'required|string|min:8|max:20',
        ]);

        if($validator->fails()){
            $error = $validator->errors();
            return response()->json(compact('error'), 400);
        }

        $data = $request->all();

        $post = Post::create($data);

        return response()->json(
            //compact('post'),
            null,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = Post::find($id);

        if ( empty($post) ){
            return response()->json(null,204);
        }

        return response()->json(compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author'  => 'required|string|min:5',
            'title'  => 'required|string|min:5',
            'text'  => 'required|string|min:10|max:255',
            'email' => 'required|email|string|min:6|max:100', // |unique:posts
            'phone' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            $error = $validator->errors();
            return response()->json(compact('error'), 400);
        }

        $post = Post::find($id);

        if ( empty($post) ){
            return response()->json(null,404);
        }
        
        $post->author = $request->get('author');
        $post->title = $request->get('title');
        $post->text = $request->get('text');
        $post->email = $request->get('email');
        $post->phone = $request->get('phone');

        $post->save();

        //compact('post')
        return response()->json(null,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if ( empty($post) ){
            return response()->json(null,404);
        }

        $post = Post::destroy($id);

        //compact('post')

        return response()->json(null,200);
    }
}
