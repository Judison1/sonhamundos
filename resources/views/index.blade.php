@extends('layouts.default')

@section('title', ' | Página Inicial')

@section('container')
	<div class="row articles-destaques">
		<h2 class="col-md-12">Principais Artigos</h2>
		<div class="col-xs-12 col-md-8">
			<!-- <div class="row"> -->
			<div id="carousel_news_headlines" class="carousel slide" data-ride="carousel">
				<?php $name = "_news_headlines"?>
				@include('articles._news_headlines')
			<!-- </div> -->
			</div>
		</div>
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
	</div>
	
	<!-- Todos os artigos -->

	<div class="row articles-all">

		<div class="col-xs-12 col-sm-8 col-md-10">
			
			<div class="row">
			<h2 class="col-xs-12">Todos os Artigos</h2>
			@foreach($articles as $art)
				<div class="col-xs-12 col-sm-6 col-md-4">
						@include('articles._article')
				</div>
			@endforeach
			</div>
		</div>

		<div class="col-xs-12 col-sm-4 col-md-2 most-viewed">
			<div class="row">
			<h4 class="text-center">Mais visualizados</h4>
			@foreach($mostViewed as $art)
				<div class="col-md-12">
					@include('articles._article')
				</div>
			@endforeach
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript">
		$(document).ready(function(){
			// $('#carousel_news_headlines').carousel({
			//   	interval: 4000
			// });
			$('#carousel_news_articles_1').carousel({
			  	interval: 3000
			});
			// $('#carousel_news_articles_2').carousel({
			//   	interval: 2000
			// });
		});
	</script>
@endsection