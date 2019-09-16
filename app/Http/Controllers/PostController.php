<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $data = [
        'title' => 'required|min:3',
        'body' => 'required|min:3',
        'category_id' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index', ['posts' => Post::orderBy('id', 'DESC')->paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create', ['categories'=> Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate($this->data);
        $data = request()->all();
        $data['user_id'] = \Auth::user()->id;
        $data['slug'] =  Post::check_slug(str_slug(request('title')));
        if(request()->has('image')){
            $imageName = time().'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('images/post'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'noimage.jpg';
        }
        Post::create($data);
        session()->flash('message-success', 'Post created');
        return redirect(url('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog/view',['post'=> $post, 'comments' => Comment::where('post_id', $post->id)->orderBy('id', 'DESC')->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('blog.edit', ['post'=> $post, 'categories'=> Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id !=  \Auth::user()->id){
            session()->flash('message-error', 'You don\'t have permission');
            return redirect(url('posts'));
        }
        request()->validate($this->data);
        $data = request()->all();
        $data['slug'] =  str_slug(request('title'));
        $data['slug'] =  Post::check_slug(str_slug(request('title')),$post->id);
        if(request()->has('image')){
            $imageName = time().'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('images/post'), $imageName);
            $data['image'] = $imageName;
        }
        $post->update($data);
        session()->flash('message-success', 'Post updated');
        return redirect(url('posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id !=  \Auth::user()->id){
            session()->flash('message-error', 'You don\'t have permission');
            return redirect(url('posts'));
        }
        $post->delete();
        session()->flash('message-error', 'Post Deleted');
        return redirect(url('posts'));
    }
}
