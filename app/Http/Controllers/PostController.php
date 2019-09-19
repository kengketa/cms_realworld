<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Category;

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
        $categories = Category::all();

        return view('posts.create')->with('categories',$categories);
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
            'image'         =>      $image,
            'published_at'  =>      $request->published_at,
            'category_id'   =>      $request->category

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
        $categories = Category::all();
        $post = Post::find($id);
        return view('posts.create')->with('post',$post)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request ,Post $post)
    {
        //$post = Post::findOrFail($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        session()->flash('status','Post Updated successfully');
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
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('status','Post deleted Permanently');
            return redirect(route('trashed-posts.index'));
        }
        else {
            $post->delete();
            session()->flash('status','Post trashed successfully');
            return redirect(route('posts.index'));
        }
       
        

    }
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index2')->with('posts',$trashed)->with('trashed',1);
        //return view('posts.index')->withPosts($trashed);   // all so works similary the above line
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('status','Post Restored successfully');
        return redirect()->back();
    }
}
