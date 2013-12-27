@extends('layouts.guest')
@section('content')
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<div class="text-center">
			<img src="{{asset('img/logo.png')}}" />
			<hr />
		</div>
		{{ Form::open(array('class' => 'form-horizontal')) }}
			<div class="row">
				<label for="email" class="col col-sm-2 control-label">Email</label>
				<div class="col col-sm-10">
					{{ Form::text('email', Session::get('email_remembered'), array('class' => 'form-control','id' => 'email', 'placeholder' => 'Email')) }}
				</div>
			</div>
			<div class="row">
				<label for="password" class="col col-sm-2 control-label">Password</label>
				<div class="col col-sm-10">
					{{ Form::password('password', array('class' => 'form-control','id' => 'password', 'placeholder' => 'Password')) }}
					<div class="checkbox">
						<label>
							{{ Form::checkbox('remember', '1', array('class' => 'form-control')) }}
							Remember me
						</label>
						<div class="pull-right">
							<small>{{ link_to('password/reset', 'Forget your password?') }}</small>
						</div>
					</div>
				</div>
				<div class="col col-sm-10 col-sm-offset-2">
					{{ Form::submit('Sign in', array('class' => 'btn btn-primary btn-block', 'style' => 'background-color: #c4339b;')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div>
@stop
