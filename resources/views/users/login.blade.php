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
				<div class="header-login text-center">
					<h1>Login</h1>
					<h1 class="glyphicon glyphicon-lock"></h1>
				</div>
				 @if (Session::has('flash_error'))
                	<div class="alert alert-danger">Usuário ou senha inválidos.</div>
            	@endif
				<div class="form-group">
					<input type="text" name="login" placeholder="Usuário" class="form-control">
					<input type="password" name="password" placeholder="Senha" class="form-control">
					<input type="checkbox" value="1" name="relembrar" /> Relembre-me
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="submit" value="Entrar" class="btn btn-primary btn-block btn-lg">
				</div>
			</form>
		</div>
</body>
</html>