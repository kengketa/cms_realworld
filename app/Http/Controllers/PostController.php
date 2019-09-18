<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\Posts\CreatePostsRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
       
        return view('posts.index2')->with('posts',$posts)->with('trashed',0);
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
     
        //$data = $request->all();
        $image = $request->image->store('posts');
        $post = Post::create([

            'title'         =>      $request->title,
            'description'   =>      $request->description,
            'content'       =>      $request->content,
            'image'         =>      $image

        ]);

        session()->flash('status','Created new Post successfully');
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
        $post = Post::find($id);
        return view('posts.create')->with('post',$post);
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
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if ($post->trashed()) {
            $post->forceDelete();
            session()->flash('status','Post deleted Permanently');
            return redirect(route('trashed-posts.index'));
        }
        else {
            $post->delete();
            session()->flash('status','Post trashed successfully');
            return redirect(route('posts.index2'));
        }
       
        

    }
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index2')->with('posts',$trashed)->with('trashed',1);
        //return view('posts.index')->withPosts($trashed);   // all so works similary the above line
    }
}
