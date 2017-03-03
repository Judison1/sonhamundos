<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/x-icon" href="{{ asset('img/layout/logo.ico') }}" />
	<title>@yield('title') | Sonha Mundos</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}">
	@yield('css')
	

</head>
<body>
	<div class="container-fluid-1">
		<header class="header">
			<div class="container">
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<input class="form-control" placeholder="Pesquisar" type="text">
					</div>
					<button type="submit" class="btn btn-default">Buscar</button>
				</form>
				<img src="{{ asset('img/layout/topo.png') }}" class="img-responsive">
			</div>
		</header>

		<nav class="cbp-hsmenu-wrapper " id="cbp-hsmenu-wrapper">
			<div class="cbp-hsinner">
				<ul class="cbp-hsmenu">
					<li><a href="/">Início</a></li>
					<li>
						<a href="#">Categorias</a>
						<ul class="cbp-hssubmenu">

							@foreach ($categories as $category)
							<li>
								<a href="{{ route('public.category', ['title' => str_slug($category->name), 'id' => $category->id ]) }}">
									<img src='{{ asset("img/category/thumbnail/$category->filename") }}' alt="{{ $category->name }}" class="img-responsive img-circle" />

									<span>{{ $category->name }}</span>
								</a>
							</li>
							@endforeach
							
						</ul>
					</li>
					<li>
						<a href="#">Autores</a>
						<ul class="cbp-hssubmenu">

							 @foreach ($authors as $author)
							<li>
								<a href="{{ route('public.author', ['name' => str_slug($author->name), 'id' => $author->id ]) }}">
									<img src='{{ asset("img/users/$author->avatar") }}' alt="{{ $author->name }}" class="img-responsive img-circle" />
									<span>{{ $author->name }}</span>
								</a>
							</li>
							 @endforeach
							
						</ul>
					</li>

					{{--<li>--}}
						{{--<a href="#">--}}
							{{--Galeria de Fotos--}}
						{{--</a>--}}
					{{--</li>--}}
					<li>
						<a href="#">
							Sobre o Sonha Mundos
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container-fluid" id="container-fluid">
			@yield('container-fluid')
		</div>

		<div class="container" id="container">
			@yield('container')
		</div>
		<footer class=" footer">
			<p class="text-center">
				Desenvolvido por Judison Godinho de Sousa
			</p>
			<p class="text-center">
				judison@outlook.com
			</p>
		</footer>
	</div>
	
</body>
	<script src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/modernizr.custom.js') }}"></script>
	<script src="{{ asset('js/cbpHorizontalSlideOutMenu.min.js') }}"></script>
	@yield('js')
	<script type="text/javascript">
		var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
	</script>
</html>