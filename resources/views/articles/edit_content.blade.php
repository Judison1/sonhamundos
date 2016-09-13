@extends('layouts.admin')

@section('title', 'Cadastro de Artigo')

@section('button')
	<a href="{{ route('article.list') }}" class="btn btn-default pull-right">Lista de Artigos</a>
@endsection

@section('container')
	<div class="row">
		<form method="POST" id="form" enctype="multipart/form-data" >

			<div class="form-group col-md-12">
					<label class="control-label">Sintese:</label>
					<textarea name="synthesis" class="form-control" maxlength="255" cols="4">{{ $article->synthesis }}</textarea>
			</div>
			
			<div class="form-group col-md-12">
				<label class="control-label">Conteudo:</label>
				<textarea name="content" class="summernote">{{ $article->content }}</textarea>
			</div>
			<input type="hidden" name="publish" class="publish" value="0">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div>
				<div class="form-group col-xs-6 col-sm-4 text-left">
					<a href="{{ route('article.edit', ['id' => $article->id]) }}"  class="btn btn-danger">
						Voltar
					</a>
				</div>
				<div class="form-group col-xs-6 col-sm-4 text-center">
					<a href="#salvar" id="salvar" class="btn btn-primary">
						Salvar
					</a>
				</div>
				<div class="form-group  col-xs-6 col-sm-4 text-right">
					<a href="#salvarepublicar" value="Salvar e Publicar" id="salvarepublicar" class="btn btn-success">
						Salvar e Publicar
					</a>
				</div>
			</div>
		</form>		
	</div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}">
@stop
@section('js')
	<script src="{{ asset('js/summernote.min.js') }}"></script>
	<script src="{{ asset('js/summernote-pt-BR.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.summernote').summernote({
				minHeight: 400,             // set minimum height of editor
  				maxHeight: 1000,
			});

			$('#salvar').click(function() {
				$('#form').submit();
			});
			$('#salvarepublicar').click(function() {
				$('.publish').val(1);
				$('#form').submit();
			});
		});
	</script>
@endsection