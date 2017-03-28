@extends('layouts.default')

@section('title', $article->title)

@section('container')
<div class="row"></div>
	
	<section class="col-md-9 col-sm-8 col-xs-12 article-view" >
		<article class="col-xs-12">
			{{-- Cabeçalho do Artigo --}}
			<header>
				<h1>{{ $article->title }}</h1>
				<h3>"{{ $article->synthesis }}"</h3>

				<div class="row article-info">
					<div class="col-sm-4">
						Autor: <a href="{{ route('public.author', ['name' => str_slug($author->name), 'id' => $author->id ]) }}" class="author"> {{ $author->name }} </a>
					</div>
					<div class="col-sm-4 text-center">
						<span class="views">{{ $article->views }} views</span>
					</div>
					<div class="col-sm-4 text-right">
						Atualizado em:
						<time pubdate="pubdate"> {{ date_format($article->updated_at, 'd/m/Y H:i') }}</time>
					</div>
				</div>
				<div class="row">
					<img src="{{ asset('img/' . $article->path . '/' . $article->filename) }}" alt="{{ $article->title }} " class="col-md-12">
				</div>
				
			</header>
			{{-- Conteudo do Artigo --}}
			<div class="article-content">
				{!! $article->content !!}
			</div>
			<footer class="row">
				<div class="col-md-12">
				<strong>Categorias: </strong>
					@foreach($articleCategories as $artcat)
					<a href="{{ route('public.category', ['title' => str_slug($artcat->name), 'id' => $artcat->id ]) }}" class="btn btn-info">
						{{ $artcat->name }}
					</a>
					@endforeach
				</div>
				<hr>
				<div class="col-md-12">
					<strong>Tags: </strong>
					@foreach($tags as $tag)
					<a href="#tag" class="btn btn-default">
						{{ $tag->name }}
					</a>
					@endforeach
				</div>
			</footer>
		</article>
	</section>

	<section class="col-md-3 col-sm-4 col-xs-12">
		<div class="row">
			<h3 class="text-center section-title">Mais visualizados</h3>
			@foreach($mostViewed as $art)
				<div class="col-md-12 box-art">
					@include('articles._article')
				</div>
			@endforeach
		</div>
	</section>
@endsection