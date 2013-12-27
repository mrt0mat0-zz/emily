@section('content')
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<div class="text-center">
			{{ HTML::image(Config::get('app.logo'), Config::get('app.name')) }}
			<hr />
		</div>
			{{ Form::open(array('class' => 'form-horizontal')) }}
				<div class="row">
					<label for="email" class="col col-sm-2 control-label">Email</label>
					<div class="col col-sm-10">
						{{ Form::text('email', Session::get('email_remembered'), array('id' => 'email', 'placeholder' => 'Email')) }}
					</div>
				</div>

				@if ( isset($token) )
					<div class="row">
						<label for="password" class="col col-sm-2 control-label">Password</label>
						<div class="col col-sm-10">
							{{ Form::password('password', array('id' => 'password', 'placeholder' => 'Password')) }}
						</div>
					</div>
					<div class="row">
						<div class="col col-sm-10 col-sm-offset-2">
							{{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'placeholder' => 'Confirm Password')) }}
						</div>
					</div>
				@endif

				<div class="row">
					<div class="col col-sm-10 col-sm-offset-2">
						{{ Form::submit('Reset Password', array('class' => 'btn btn-primary btn-block')) }}
						<hr />
						<p class="text-center">
							<small>{{ HTML::linkRoute('login', '&larr; Back to login') }}</small>
						</p>
					</div>
				</div>

				@if ( isset($token) )
					<input type="hidden" name="token" value="{{ $token }}">
				@endif

			{{ Form::close() }}
	</div>
</div>
@stop
