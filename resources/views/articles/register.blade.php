@extends('layouts.admin')

@section('title', 'Cadastro de Artigo')

@section('button')
	<a href="#{{-- route('articles.list') --}}" class="btn btn-default pull-right">Lista de Artigos</a>
@endsection

@section('container')
	<div class="row">
		<form method="POST" enctype="multipart/form-data" >
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Nome:</label>
					<input class="form-control" type="text" name="title" placeholder="Nome do Artigo" required />
			</div>
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Categoria: <small class="text-info">(Permitido selecionar mais de uma)</small></label>
					<select name="categories[]" class="categories" multiple="multiple">
						<option>Selecione as Categorias</option>
						@foreach ($cats as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach
					</select>
			</div>
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Tags: </label>
					<select name="tags[]" class="tags" multiple="multiple">
						@foreach ($tags as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
					</select>
			</div>
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Capa: <!-- <small class="text-danger">(Apenas imagens com extensões: .jpeg, .jpg, .png, .gif e .webp)</small> --></label>
					<input type="file" name="filename" accept=".jpeg, .jpg, .gif, .png" required>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="form-group col-md-12 text-center">
				<input type="submit" value="Salvar e Avançar" class="btn btn-success center-block">
			</div>
		</form>		
	</div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}">
@stop
@section('js')
	<script src="{{ asset('js/standalone/selectize.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".categories").selectize({
				plugins: ['remove_button'],
				maxItems: "none",
				hideSelected: 'true',
				render: {
			      item: function(data, escape) {
			         return '<div>"' + escape(data.text) + '"</div>';
			      }

			   },
			   onDelete: function(values) {
			       return true;
		    	}
			});
			$(".tags").selectize({
				plugins: ['remove_button'],
				maxItems: "none",
			   create: true,
			   hideSelected: 'true',
			   render: {
			      item: function(data, escape) {
			         return '<div>"' + escape(data.text) + '"</div>';
			      }
			   },
			   onDelete: function(values) {
			       return true;
		    	}
			});
		});
	</script>
@endsection