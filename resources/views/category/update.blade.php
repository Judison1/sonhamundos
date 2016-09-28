@extends('layouts.admin')

@section('title', 'Alteração da Categoria: '. $cat->name)

@section('button')
	<a href="{{ route('category.list') }}" class="btn btn-default pull-right">Lista de Categorias</a>
@endsection

@section('container')
	@include('_errors')
	<div class="row">
		<form method="POST" id="form" enctype="multipart/form-data" class="form-horizontal" >

			<div class="form-group col-md-6">
				<div class="col-md-12">
					<label class="control-label">Nome:</label>
					<input class="form-control" type="text" name="name" placeholder="Nome da Categoria" value="{{ $cat->name }}" required />
				</div>
			</div>
			
			
			<div class="form-group col-md-6">
				<div class="col-md-12">
					<label class="control-label">Selecionar nova Capa: <small class="text-danger">(Substituirá a imagem de capa atual)</small></label>

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
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-12">
					<label class="control-label">Descrição:</label>
					<textarea name="description" class="form-control">{{ $cat->description }}</textarea>
				</div>
			</div>
			@if(file_exists(public_path('img/category') . '/' . $cat->filename))
				<div class="form-group col-md-12">
					<label class="control-label"> Recortar Imagem: 
						<small class="text-danger">
						(Posicione a Imagem de acordo com a área que desejas mostrar no artigo)
						</small>
					</label>
					<div class="crop-img"></div>
					<input class="input-img" type="hidden" name="img">
				</div>
			
						<!-- <img src="{{ asset('img/category/' . $cat->filename) }}" class="img-responsive"> -->
					
			@endif
			<input type="hidden" name="id" value="{{ $cat->id }}" />
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="form-group col-md-12 text-center">
				<a href="#form" class="result btn btn-success">Salvar</a href="#form">
			</div>
		</form>		
	</div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/croppie.css') }}">
@endsection
@section('js')
	<script src="{{ asset('js/croppie.min.js') }} "></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var basic = $('.crop-img').croppie({
		    	viewport: {
		        width: 500,
		        height: 500
		    	},
		    	boundary: { width: 500, height: 500 },
			});
			basic.croppie('bind', {
		    	url: '{{ asset("img/category/$cat->filename") }}',
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