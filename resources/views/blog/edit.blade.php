@extends('layouts.public')

@section('title', 'Edit Post')

@section('content')
<h2>Edit Post</h2>
<form action="{{url('posts/'.$post->slug)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
      <label>Title</label>
      <input value="{{$post->title}}" type="text" class="form-control" placeholder="Add Title" name="title">
    </div>
    <div class="form-group">
    <label>Body</label>
    <textarea id="editor" class="form-control" name="body" id="" cols="30" rows="10">{{$post->body}}</textarea>
    </div>
    <div class="form-group">
      <label>Category</label>
      <select name="category_id" class="form-control">
        @foreach ($categories as $cat) 
        @if($post->category_id == $cat->id)
            <option selected value="{{$cat->id}}">{{$cat->name}}</option>
        @else
            <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Uplodad Image</label>
      <input type="file" class="form-control-file" name="image" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
        
@section('script')
<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
        
        
        
 
        