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
	<div class="container-fluid">
		<header class="row header">
			<div class="container">
				<img src="{{ asset('img/layout/topo.png') }}" class="img-responsive">
			</div>
		</header>

		<nav class="cbp-hsmenu-wrapper row" id="cbp-hsmenu-wrapper">
			<div class="cbp-hsinner">
				<ul class="cbp-hsmenu">
					<li><a href="/">Início</a></li>
					<li>
						<a href="#">Categorias</a>
						<ul class="cbp-hssubmenu">

							@foreach ($categories as $category)
							<li>
								<a href="{{ route('public.view', ['title' => str_slug($category->name), 'id' => $category->id ]) }}">
									<img src='{{ asset("img/category/$category->filename") }}' alt="{{ $category->name }}" class="img-responsive img-circle" />

									<span>{{ $category->name }}</span>
								</a>
							</li>
							@endforeach
							
						</ul>
					</li>
					<li>
						<a href="#">Autores</a>
						<ul class="cbp-hssubmenu">

							{{-- @foreach ($categories as $category) --}}
							<li>
								<a href="#{{-- route('public.view', ['title' => str_slug($category->name), 'id' => $category->id ]) --}}">
									{{-- <img src='{{ asset("img/category/$category->filename") }}' alt="{{ $category->name }}" class="img-responsive" /> --}}

									<span>Teste{{-- $category->name --}}</span>
								</a>
							</li>
							{{-- @endforeach --}}
							
						</ul>
					</li>

					<li>
						<a href="#">
							Galeria de Fotos
						</a>
					</li>
					<li>
						<a href="#">
							Sobre
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container" id="container">
			@yield('container')
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
	<script src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/modernizr.custom.js') }}"></script>
	<script src="{{ asset('js/cbpHorizontalSlideOutMenu.min.js') }}"></script>
	@yield('js')
	<script type="text/javascript">
		var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
	</script>
</html>