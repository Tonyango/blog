@extends('main')

@section('title', '| Edit Post')

@section('content')

	<div class="row">

			<div class="col-md-7">

				{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}

				{{ Form::label('title', 'Title:') }}			
				{{ Form::text('title', null, ['class' => 'form-control form-control-lg']) }}

				{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing top']) }}			
				{{ Form::text('slug', null, ['class' => 'form-control']) }}

				{{ Form::label('body', 'Body:', ['class' => 'form-spacing top']) }}
				{{ Form::textarea('body', null, ['class' => 'form-control']) }}

			</div>

			<div class="col-md-5">
				
				<div class="card" style="background: #d7d9db; padding: 10px; margin-top: 30px;">
					
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
							
							{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}

						</div>
						<div class="col-sm-6">

							{{ Form::submit('Update', ['class' => 'btn btn-success btn-block']) }}

						</div>
					</div>

				</div>

			</div>

		{!! Form::close() !!}

	</div> <!--End of row (form)-->
	

@endsection