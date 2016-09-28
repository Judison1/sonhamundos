@extends('layouts.admin')

@section('title', "Editando o Artigo: $article->title")

@section('button')
	<a href="#{{-- route('articles.list') --}}" class="btn btn-default pull-right">Lista de Artigos</a>
@endsection

@section('container')
	<form id="form" method="POST" enctype="multipart/form-data" >
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Título:</label>
					<input class="form-control" type="text" name="title" placeholder="Título do Artigo" value="{{ $article->title }}" required />
			</div>
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Categoria: <small class="text-info">(Permitido selecionar mais de uma)</small></label>
					<select name="categories[]" class="categories" multiple="multiple">
						<option>Selecione as Categorias</option>
						@for ($i = 0; $i < count($categories) ; $i++)
							<?php $cat = (object) $categories[$i]; ?>
							<option value="{{ $cat->id }}" {{ $cat->status }}>
								{{ $cat->name }}
							</option>
						@endfor
					</select>
			</div>
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Tags: </label>
					<select name="tags[]" class="tags" multiple="multiple">
						<option value="1">tettsts</option>
						<option value="2">tetts</option>
						<option value="3">tevcssts</option>
					</select>
			</div>
			<div class="form-group col-md-6 col-xs-12">
					<label class="control-label">Capa: <small class="text-danger">(Substituirá a imagem de capa atual)</small></label>
					<div class="col-md-12 form-control">
						<div class="row">
							<div class="col-xs-9">
								<input type="file" name="filename" class="filename" accept=".jpeg, .jpg, .gif, .png">
							</div>
							<div class="col-xs-3">
								<a href="#file" class="btn-file btn btn-xs btn-primary">Enviar Imagem</a>
							</div>
						</div>
					</div>
			</div>
		<div class="form-group col-xs-12">
			<label class="text-center"> Recortar Imagem: 
				<small class="text-danger">
				(Posicione a Imagem de acordo com a área que desejas mostrar no artigo)
				</small>
			</label>
			<div class="crop-img"></div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input class="input-img" type="hidden" name="img">
		</div>
		<div class="form-group col-xs-12 text-center">
			<a href="#form" class="result btn btn-success">Salvar e Avançar</a>
		</div>
	</form>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/croppie.css') }}">
@stop

@section('js')
	<script src="{{ asset('js/standalone/selectize.min.js') }}"></script>
	<script src="{{ asset('js/croppie.min.js') }} "></script>
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
		var basic = $('.crop-img').croppie({
		    viewport: {
		        width: 750,
		        height: 475
		    },
		    boundary: { width: 750, height: 475 },
		});
		basic.croppie('bind', {
		    url: '{{ asset("img/$article->path/$article->filename") }}',
		    // points: [77,469,280,739]
		});
		$('.btn-file').click(function() {
			if($('.filename').val() != "") {
				$('.input-img').val("");
         	$('#form').submit();
			} else {
				alert('Selecione uma imagem antes de enviar')
			}
		});
		$('.result').click(function() {
			console.log(basic.get());
			basic.croppie('result', {
            type: 'canvas',
            size: 'original'
        	}).then(function (resp) {
            $('.input-img').val(resp);
            $('#form').submit();
			});
      });
   });
	</script>
@endsection