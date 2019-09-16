@extends('layouts.public')

@section('title', 'Category '.$name)

@section('style')
 <style>
 .pagination{ text-align: center; margin: 0 auto }
 </style>   
@endsection


@section('content')
    <h2>Category {{$name}}</h2>

@foreach ($posts as  $post)
<h3>{{$post->title}}</h3>
<small class="post-date">{{$post->created_at}} in <strong>{{$post->cateegory->name}}</strong></small>
<div class="row ">
    <div class="col-md-3">
    <img  class="img-thumbnail img-fluid" src="{{asset('images/post/'.$post->image)}}" alt="{{$post->image}}">
    </div>
    <div class="col-md-9">
        {!!$post->body!!}
        <p><a class="btn btn-secondary" href="{{url('posts/'.$post->slug)}}">Read More</a></p>
    </div>
</div>

@endforeach
<br>
<div class="row">
    <div class="col-md-4 offset-md-5 text-center">
        {{$posts->links()}}
    </div>
</div>


@endsection