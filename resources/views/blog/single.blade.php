@extends('main')

@section('title', "| $post->title")

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<img src="{{ asset('images/' . $post->image) }}" height="400" width="800" />
			
			<h1>{{ $post->title }}</h1>
			<p>{!! $post->body !!}</p>

			<hr>

			<p>Posted In: {{ $post->category->name }}</p>

		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="comments-title"><i class="fa fa-comment" aria-hidden="true"></i> {{ $post->comments()->count() }} Comments</h3>
			
			@foreach($post->comments as $comment)
				
				<div class="comment">
					
					<div class="author-info">

						<img src=" {{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=wavatar" }} " class="author-image">

						<div class="author-name">
							
							<h5>{{ $comment->name }}</h5>
							<p class="author-time">{{ date('jS M, Y - H:i e' ,strtotime($comment->created_at)) }}</p>

						</div>
					
					</div>

					<div class="comment-content">
						
						{{ $comment->comment }}

					</div>

				</div>

				<hr>

			@endforeach

		</div>
	</div>

	<hr>

	<div class="row">
		<div  class="col-md-8 c0l-md-offset-2 form-spacing-top" id="comment-form">
			
			{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

				<div class="row">
					<div class="col-md-6">
						
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}

					</div>
					<div class="col-md-6">
						
						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}

					</div>

					<div class="col-md-12 btn-spacing">
						
						{{ Form::label('comment', 'Comment:') }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

						{{ Form::submit('Add comment', ['class' => 'btn btn-success btn-block btn-spacing']) }}

					</div>

				</div>

			{{ Form::close() }}

		</div>
	</div>

@endsection