<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;

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
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);
        //check if new image
        if($request->hasFile('image')){
            // upload it
            $image = $request->image->store('posts');
            // delete old one
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        session()->flash('success', 'Post Updated Successfully.');
        return redirect(route('posts.index')); 
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
            $post->deleteImage();
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
        // $trashed = Post::withTrashed()->get();
        $trashed = Post::onlyTrashed()->get();
        // return view('posts.index')->withPosts($trashed);
        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post Restored Successfully.');
        return redirect()->back();
    }
}
