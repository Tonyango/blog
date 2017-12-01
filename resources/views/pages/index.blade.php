@extends('main')

@section('title', '| Home')

@section('content')

        <div class="row"> 
            <div class="col-md-12">
                
                <div class="jumbotron">
                  <h1 class="display-3">Welcome to My Blog!</h1>
                  <p class="lead">Thank you for visiting. This is my test website built with Laravel. Please read my latest post</p>
                  <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Popular post</a>
                  </p>
                </div>

            </div>
        </div> <!-- End of jumbotron row -->

        <div class="row">
            <div class="col-md-8">

              @foreach($posts as $post)
                  
                 <div class="post">
                     
                      <h3>{{ $post->title }}</h3>
                      <p>{{ substr($post->body, 0, 300) }} {{ strlen($post->body) > 300 ? "..." : "" }}</p>
                      <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary"> Read More </a>

                 </div>

                 <hr>

              @endforeach
              
            </div>
            <div class="col-md-3 col-md-offset-1">
                
                <h2>Sidebar</h2>

            </div>

        </div>

@endsection