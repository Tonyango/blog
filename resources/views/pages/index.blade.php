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
                
               <div class="post">
                   
                    <h3>Post Title</h3>
                    <p>Pariatur amet non minim labore veniam dolor qui officia dolore commodo esse deserunt dolor aliqua...</p>
                    <a href="#" class="btn btn-primary"> Read More </a>

               </div>
               <hr>
               <div class="post">
                   
                    <h3>Post Title</h3>
                    <p>Pariatur amet non minim labore veniam dolor qui officia dolore commodo esse deserunt dolor aliqua...</p>
                    <a href="#" class="btn btn-primary"> Read More </a>

               </div>
               <hr>
               <div class="post">
                   
                    <h3>Post Title</h3>
                    <p>Pariatur amet non minim labore veniam dolor qui officia dolore commodo esse deserunt dolor aliqua...</p>
                    <a href="#" class="btn btn-primary"> Read More </a>

               </div>
               <hr>
               <div class="post">
                   
                    <h3>Post Title</h3>
                    <p>Pariatur amet non minim labore veniam dolor qui officia dolore commodo esse deserunt dolor aliqua...</p>
                    <a href="#" class="btn btn-primary"> Read More </a>

               </div>

            </div>
            <div class="col-md-3 col-md-offset-1">
                
                <h2>Sidebar</h2>

            </div>

        </div>

@endsection