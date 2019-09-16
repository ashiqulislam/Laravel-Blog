@extends('layouts.public')

@section('title', 'Category')



@section('content')
    <h1>Category</h1>
    <ul class="list-group">
            @foreach ($categories as  $cat)
              <li class="list-group-item"><a href="{{url('category/'.$cat->slug)}}">{{$cat->name}}</a>
                @auth
                @if(Auth::user()->id == $cat->user_id)
                    <form action="{{url('category/'.$cat->slug)}}" method="POST" style="display:inline" >
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="[x]" class="btn btn-link text-danger">
                    </form>    
                @endif
                @endauth             
               </li>
            @endforeach
             
            
            </ul>
@endsection

