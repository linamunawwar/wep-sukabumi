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
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
				{!! BootForm::open(['url' => url('/login'), 'method' => 'post']) !!}
                    
				<h1>Login Form</h1>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				{!! BootForm::text('pegawai_id', 'ID Pegawai', old('email'), ['placeholder' => 'ID Pegawai', 'afterInput' => '<span>test</span>'] ) !!}
			
				{!! BootForm::password('password', 'Password', ['placeholder' => 'Password']) !!}
				
				<div>
					{!! BootForm::submit('Log in', ['class' => 'btn btn-default submit']) !!}
					<a class="reset_pass" href="{{  url('/password/reset') }}">Lost your password ?</a>
				</div>
                    
				<div class="clearfix"></div>
                    
				<div class="separator">
					<!-- <p class="change_link">New to site?
						<a href="{{ url('/register') }}" class="to_register"> Create Account </a>
					</p>
 -->                        
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
</div>
</body>
</html>