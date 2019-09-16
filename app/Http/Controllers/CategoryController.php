<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index',['categories' => Category::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(['name'=> 'required']);
        $data = ['user_id' => \Auth::user()->id, 'name' => request('name'), 'slug' => Category::check_slug(str_slug(request('name')))];
        Category::create($data);
        session()->flash('message-success', 'Category created');
        return redirect(url('category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show', ['name' =>$category->name, 'posts' => Post::where('category_id', $category->id)->orderBy('id', 'DESC')->paginate(3)]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(\Auth::user()->id == $category->user_id){
            $category->delete();
            session()->flash('message-error', 'Category deleted');
            return redirect(url('category'));
        } 
        session()->flash('message-error', 'You don\'t have permission');
        return redirect(url('category'));
    }
}
