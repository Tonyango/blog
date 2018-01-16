@extends('main')

@section('title', '| View Post')

@section('content')

	<div class="row">

		<div class="col-md-7">

			<img src="{{ asset('images/' . $post->image) }}" alt="This is a photo" />
			
			<h1> {{ $post->title }} </h1>

			<p class="lead"> {!! $post->body !!} </p>

			<hr>

			<div class="tags">
				
				@foreach ($post->tags as $tag)

					<span class="badge badge-default" style="background: #000; color: #fff;"> {{ $tag->name }} </span>

				@endforeach

			</div>

			<div id="backend-comments" style="margin-top: 50px;">
				
				<h3><small> {{ $post->comments()->count() }} </small> comments</h3>

				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comments</th>
							<th width="70px"></th> 
						</tr>
					</thead>
					<tbody>
						@foreach($post->comments as $comment)
							<tr>
								<td> {{ $comment->name }} </td>
								<td> {{ $comment->email }} </td>
								<td> {{ $comment->comment }} </td>
								<td>
									<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>

		</div>

		<div class="col-md-5">
			
			<div class="card" style="background: #d7d9db; padding: 10px;">

				<dl class="row">
					
					<dt class="col-sm-4">Url:</dt>
					<dd class="col-sm-8"> <a href="{{ route('blog.single', $post->slug) }}">{{ url('blog/'.$post->slug) }}</a> </dd>

				</dl>

				<dl class="row">
					
					<dt class="col-sm-4">Category:</dt>
					<dd class="col-sm-8"> {{ $post->category->name }} </dd>

				</dl>
				
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

				<div class="row">
					<div class="col-md-12">
						
						{{ Html::linkRoute('posts.index', 'View all posts', [], ['class' => 'btn btn-secondary btn-block btn-h1-spacing']) }}

					</div>
				</div>

			</div>

		</div>

	</div>
	

@endsection