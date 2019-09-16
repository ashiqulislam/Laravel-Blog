@extends('layouts.public')

@section('title', 'Create Category')



@section('content')
    <h2>Create Category</h2>

<form action="{{url('category')}}" method="post">
        @csrf
        <div class="form-group">
            <label >Name</label>
            <input name="name" type="text" class="form-control" placeholder="Add Name">
        </div>
     <button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection