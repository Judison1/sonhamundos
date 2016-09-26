@extends('layouts.default')

@section('title', 'Página Inicial')

@section('container')
	<section class="row articles-destaques">
		{{-- Principais Artigos --}}
		<h2 class="col-md-12 text-center section-title">Principais Artigos</h2>

		{{-- Manchetes --}}
		<div class="col-xs-12 col-md-8">

			<div id="carousel_news_headlines" class="carousel slide" data-ride="carousel">
				<?php $name = "_news_headlines"?>
				@include('articles._news_headlines')
			</div>
			
		</div>

		{{-- Mais Recentes --}}
		<div class="col-xs-12 col-md-4">
			<div class="row">

				<div class="col-xs-12">
					<!-- <h3>Principais Artigos</h3> -->
					<div id="carousel_news_articles_1" class="carousel slide" data-ride="carousel">
						<?php $name = "_news_articles_1"?>
						@include('articles._news_articles_1')
					</div>
					
				</div>

				<div class="col-xs-12">
					<!-- <h3>Principais Artigos</h3> -->
					<div id="carousel_news_articles_2" class="carousel slide" data-ride="carousel">
						<?php $name = "_news_articles_2"?>
						@include('articles._news_articles_2')
					</div>
				</div>

			</div>
		</div>
	</section>
	
	<!-- Todos os artigos -->

	<section class="row">
		{{-- Mais visualizados --}}
		<div class="col-xs-12 most-viewed">
			<h2 class="text-center section-title">Mais visualizados</h2>
			<div class="row">
				
				@foreach($mostViewed as $art)
					<div class="col-xs-12 col-sm-4 col-md-3 box-art">
						@include('articles._article')
					</div>
				@endforeach

			</div>
		</div>

		{{-- Todos os Artigos --}}
		<div class="col-md-12 articles-all">
			<div class="row">

				<h2 class="section-title text-center">Todos os Artigos</h2>
				@foreach($articles as $art)
					<div class="col-xs-12 col-sm-6 col-md-4 box-art">
							@include('articles._article')
					</div>
				@endforeach

			</div>
			{{-- Paginação --}}
			{{ $articles->links() }}
		</div>

	</section>
@endsection

@section('js')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#carousel_news_headlines').carousel({
			  	interval: 5000
			});
			$('#carousel_news_articles_1').carousel({
			  	interval: 4000
			});
			$('#carousel_news_articles_2').carousel({
			  	interval: 2500
			});
		});
	</script>
@endsection