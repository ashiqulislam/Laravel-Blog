<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <style>
  .post-date {
    background: #f4f4f4;
    padding: 4px;
    margin: 3px 0;
    display: block;
}
  </style>
  @yield('style')

  <title>Blog - @yield('title')</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
                <a class="navbar-brand" href="#">Laravel Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('posts')}}">Blog</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('category')}}">Categories</a>
                    </li>
                  </ul>
                  
                  
                  <ul class="navbar-nav mr-right">
                      @guest                        
                        <li class="nav-item">
                          <a class="nav-link" href="{{url('login')}}">Login</a>
                          
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{url('register')}}">Register</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('posts/create')}}">Create Post</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{url('category/create')}}">Create Category</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                           </a>  
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                          </li>
                        @endguest
                      </ul>
                </div>

        </div>
        
      </nav>

    <div class="container">

        @if($errors->any())
        <div class="row">
          <div class="col-lg-12">    
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $er)
                    <li>{{$er}}</li>
                  @endforeach
                </ul>
              </div>
          </div>
        <!-- /.col-lg-12 -->
        </div>
        @endif
        
        <div class="col-lg-12">
          @if (Session::has('message-error'))
          <div class="alert alert-danger" role="alert">{{Session::get('message-error')}}</div>
          @endif
          @if (Session::has('message-success'))
          <div class="alert alert-success" role="alert">{{Session::get('message-success')}}</div>
          @endif
        </div>

        @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
    @yield('script')
  </body>
</html>