@extends('layouts.admin')

@section('title', 'Cadastro de Artigo')

@section('button')
	<a href="#{{-- route('articles.list') --}}" class="btn btn-default pull-right">Lista de Artigos</a>
@endsection

@section('container')
	<div class="row">
		<form method="POST" enctype="multipart/form-data" >
			<div class="form-group col-md-12">
					<label class="control-label">Nome:</label>
					<input class="form-control" type="text" name="title" placeholder="Nome do Artigo" required />
			</div>
			<div class="form-group col-md-12">
					<label class="control-label">Sintese:</label>
					<textarea name="synthesis" class="form-control" maxlength="255" cols="4"></textarea>
			</div>
			
			<div class="form-group col-md-12">
				<label class="control-label">Conteudo:</label>
				<textarea name="content" class="summernote"></textarea>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="form-group col-md-12 text-center">
				<input type="submit" value="Cadastrar" class="btn btn-primary center-block">
			</div>
		</form>		
	</div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.css') }}">
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
		});
	</script>
@endsection