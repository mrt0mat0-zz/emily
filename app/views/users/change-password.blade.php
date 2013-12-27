@section('content')
<div class="page-header">
	<h1>Change Your Password</h1>
</div>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">

			{{ Form::open(array('class' => 'form-horizontal')) }}
				<div class="row">
					<label for="password" class="col col-sm-3 control-label">Current Password</label>
					<div class="col col-sm-9">
						{{ Form::password('password', array('id' => 'password', 'placeholder' => 'Current Password')) }}
					</div>
				</div>
				<div class="row">
					<label for="password" class="col col-sm-3 control-label">New Password</label>
					<div class="col col-sm-9">
						{{ Form::password('new_password', array('id' => 'password', 'placeholder' => 'New Password')) }}
					</div>
				</div>
				<div class="row">
					<div class="col col-sm-9 col-sm-offset-3">
						{{ Form::password('new_password_confirmation', array('id' => 'password_confirmation', 'placeholder' => 'Confirm New Password')) }}
					</div>
				</div>

				<div class="row">
					<div class="col col-sm-9 col-sm-offset-3">
						{{ Form::submit('Change Password', array('class' => 'btn btn-primary btn-block')) }}
					</div>
				</div>

			{{ Form::close() }}
	</div>
</div>
@stop