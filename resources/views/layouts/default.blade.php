<!DOCTYPE html>
<html>
<head>
	<title>Sonha Mundos @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}">
	@yield('css')
	

</head>
<body>
	<div class="container-fluid">
		<header class="row">
			<h1 class="col-md-12">
				<span class="glyphicon glyphicon-cloud col-md-1"> </span>
				<span class="col-md-11">Sonha Mundos <small>Alpha</small>
				</span>
			</h1>
			<div class="background row"></div>
			

		</header>

		<nav class="cbp-hsmenu-wrapper row" id="cbp-hsmenu-wrapper">
			<div class="cbp-hsinner">
				<ul class="cbp-hsmenu">
					<li><a href="/">Início</a></li>
					<li>
						<a href="#">Categorias</a>
						<ul class="cbp-hssubmenu">
							<li>
								<a href="#">
									<!-- <img src="images/1.png" alt="img01"/> -->
									<span>Delicate Wine</span>
								</a>
							</li>
							
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
		<footer class="row">
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