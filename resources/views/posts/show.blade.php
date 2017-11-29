@extends('main')

@section('title', '| View Post')

@section('content')

	<div class="row">

		<div class="col-md-7">
			
			<h1> {{ $post->title }} </h1>

			<p class="lead"> {{ $post->body }} </p>

		</div>

		<div class="col-md-5">
			
			<div class="card" style="background: #d7d9db; padding: 10px;">
				
				<dl class="row">
					
					<dt class="col-sm-4">Created:</dt>
					<dd class="col-sm-8"> {{ date('jS M Y H:i e', strtotime($post->created_at)) }} </dd>

				</dl>

				<dl class="row">
					
					<dt class="col-sm-4">Last Updated:</dt>
					<dd class="col-sm-8"> {{ date('jS M Y H:i e', strtotime($post->updated_at)) }} </dd>

				</dl>

				<hr>

				<div class="row">
					<div class="col-sm-6">
						
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}

					</div>
					<div class="col-sm-6">

						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
						
						{!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}

					</div>
				</div>

			</div>

		</div>

	</div>
	

@endsection