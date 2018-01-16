@extends('main')

@section('title', '| Forgot Password')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			
			<div class="card">
				
				<div class="card-header"><h5>Reset Password</h5></div>

				<div class="card-block" style="padding: 10px;">

					@if (session('status'))

						<div class="alert alert-success">
							
							{{ session('status') }}

						</div>

					@endif
					
					{!! Form::open(['url' => 'password/email', 'method' => 'POST']) !!}

						{{ Form::label('email', 'Email Address:') }}
						{{ Form::email('email', null, ['class' => 'form-control']) }}

						{{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

					{!! Form::close() !!}

				</div>

			</div>

		</div>
	</div>

@endsection