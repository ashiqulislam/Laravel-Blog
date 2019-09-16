@extends('layouts.public')

@section('title', $post->title)



@section('content')
<h2>{{$post->title}}</h2>
    <small class="post-date">{{$post->created_at}}</small>
    <img class="img-thumbnail img-fluid" src="{{asset('images/post/'. $post->image)}}" alt="{{$post->image}}">
    <div class="post-body">    
     {!!$post->body!!}
    </div>
    @auth
        @if(Auth::user()->id == $post->user_id)
        <hr>
        <a class="btn btn-secondary float-left" href="{{url('posts/'.$post->slug.'/edit')}}" >Edit</a>
        <form action="{{url('posts/'.$post->slug)}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" value="Delee" class="btn btn-danger">
        </form>
        @endif
    @endauth

    <hr>
    <h3>Comments</h3>
    @if($comments)
        @foreach($comments as $comment)
            <div class="card card-body bg-light">
                <h5>{{$comment->body}} [by <strong>{{$comment->name}}</strong>]</h5>
            </div>
        @endforeach
    @else
        <p>No Comments To Display</p>
    @endif
    <hr>
    <h3>Add Comment</h3>
    <form action="{{url('comments')}}" method="post" enctype="multipart/form-data">
        @csrf
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea name="body"cols="30" rows="5" class="form-control"></textarea>
    </div>
    <input type="hidden" name="slug" value="<?php echo $post->slug; ?>">
    <input type="submit" value="Submit" class="btn btn-primary">
    </form>

    @endsection