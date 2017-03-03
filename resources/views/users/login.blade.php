<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<script src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body class="body-login">
		<div class="container-fluid">
			<form class="login col-md-4 col-md-offset-4" method="post">
				{!! csrf_field() !!}
				<div class="header-login text-center">
					<h1>Login</h1>
					<h1 class="glyphicon glyphicon-lock"></h1>
				</div>
			
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Digite seu E-mail">

              	@if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              	@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<input type="password" class="form-control" name="password" placeholder="Digite sua Senha">

              	@if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              	@endif
				</div>
				<div class="form-group">
					<input type="checkbox" value="1" name="relembrar" /> Relembre-me
				</div>
					
				<div class="form-group">
					<input type="submit" value="Entrar" class="btn btn-primary btn-block btn-lg">
				</div>
				<a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu sua Senha?</a>
				</div>
			</form>
		</div>
</body>
</html>