<?php
	use App\Roles;

	$roles = Roles::pluck('name','id');
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="{{asset('public/img/Waskita.png')}}" rel='icon' type='image/x-icon'/>
    <title>WEP - Becakayu 2A </title>
    
    <!-- Bootstrap -->
    <link href="{{ asset("public/css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("public/css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("public/css/gentelella.min.css") }}" rel="stylesheet">

</head>

<body class="login">
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
			{!! BootForm::open(['url' => url('/register'), 'method' => 'post']) !!}
			
			<h1>Create Account</h1>

			{!! BootForm::text('name', 'Name', old('name'), ['placeholder' => 'Full Name']) !!}

			{!! BootForm::email('email', 'Email', old('email'), ['placeholder' => 'Email']) !!}

			{!! BootForm::password('password', 'Password', ['placeholder' => 'Password']) !!}

			{!! BootForm::password('password_confirmation', 'Password confirmation', ['placeholder' => 'Confirmation']) !!}
			
			<div class="form-group">
				<label for="role" class="control-label">Role</label>
				<div>
					<select class="form-control" id="role" name="role" required="required">
						<option value="">---Pilih Role---</option>
						@foreach($roles as $key=>$role)
							<option value="{{$key}}">{{$role}}</option>
						@endforeach
					</select>
				</div>
			</div>	

			<div class="form-group">
				<div style="padding-left: 100px;">
					<input class="btn btn-default" type="submit" value="Register">
				</div>
			</div>
		   
			<div class="clearfix"></div>
			
			<div class="separator">
				<p class="change_link">Already a member ?
					<a href="{{ url('/login') }}" class="to_register"> Log in </a>
				</p>
				
				<div class="clearfix"></div>
				<br />
				
				<div>
					<h1><img src="{{asset('public/img/Waskita-noback.png')}}" width="100px"><br><br> Waskita E-Project</h1>
					<p>©2019 All Rights Reserved.</p>
				</div>
			</div>
			{!! BootForm::close() !!}
        </section>
    </div>
</div>
</body>
</html>