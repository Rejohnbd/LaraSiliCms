<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // upload the image to store
        $image = $request->image->store('posts');
        // create the post
        Post::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'content'       => $request->content,
            'image'         => $image,
            'published_at'  => $request->published_at
        ]);
        session()->flash('success', 'Post Create Successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if($post->trashed()){
            Storage::delete($post->image);
            $post->forceDelete();
            session()->flash('success', 'Post Deleted Successfully.');
        }else{
            $post->delete();
            session()->flash('success', 'Post Trashed Successfully.');
        }
        return redirect(route('posts.index')); 
    }

    /**
     * Display a list of all trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::withTrashed()->get();
        // return view('posts.index')->withPosts($trashed);
        return view('posts.index')->with('posts', $trashed);
    }
}
