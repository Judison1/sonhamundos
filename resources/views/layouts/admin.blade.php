<!DOCTYPE html>
<html>
<head>
	<title>Admin - @yield('title')</title>
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	@yield('css')
	<script src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body>
	<div class="container-fluid">
		<header class="row">
			<div class="col-xs-8 col-sm-9 col-md-11">
				<div class="col-xs-8"><h3>Sonha Mundos</h3></div>
				<!-- <div class="col-xs-4"> {{ Auth::user()->name }} </div> -->
			</div>
			<div class="col-xs-4 col-sm-3 col-md-1 logout">
				<a href="{{ url('/logout') }}">
				<i class="glyphicon glyphicon-off"></i>
				<span>Sair</span>
				</a>
			</div>
		</header>
		<div class="row">
			<nav class="col-xs-12 col-sm-4 col-md-2" id="menu">
				<ul class="row">
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							<span>Perfil</span>
						</a>
					</li>
					<li>
						<a href="{{ route('article.list') }}">
							<i class="glyphicon glyphicon-file"></i>
							<span>Artigos</span>
						</a>
					</li>
					<li>
						<a href="{{ route('category.list') }}">
							<i class="glyphicon glyphicon-th-large"></i>
							<span>Categorias</span>
						</a>
					</li>
				</ul>
			</nav>
			<div class="col-xs-12 col-sm-8 col-md-10" id="container">
				<div class="col-xs-12 painel-top">
					<div class="col-md-8">
						<h3>@yield('title')</h3>
					</div>
					<div class="col-md-4">
						@yield('button')
					</div>
					
				</div>
				@yield('container')
			</div>
		</div>
		<footer class="row footer">
			<p class="text-center">
				Desenvolvido por Judison Godinho de Sousa
			</p>
			<p class="text-center">
				judison@outlook.com
			</p>
		</footer>
	</div>
	
</body>
	@yield('js')
</html>