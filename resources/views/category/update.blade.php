@extends('layouts.admin')

@section('title', 'Alteração da Categoria: '. $cat->name)

@section('button')
	<a href="{{ route('category.list') }}" class="btn btn-default pull-right">Lista de Categorias</a>
@endsection

@section('container')
	<div class="row">
		<form method="POST" enctype="multipart/form-data" class="form-horizontal" >

			<div class="form-group col-md-12">
				<div class="col-md-12">
					<label class="control-label">Nome:</label>
					<input class="form-control" type="text" name="name" placeholder="Nome da Categoria" value="{{ $cat->name }}" required />
				</div>
			</div>
			@if(file_exists(public_path('img\category') . '\\' . $cat->filename)))
				<div class="form-group col-md-6">
					<div class="col-md-12">
						<label class="control-label">Capa:</label>
						<img src="{{ asset('img/category/' . $cat->filename) }}" class="img-responsive">
					</div>
				</div>
			@endif
			<div class="form-group col-md-6">
				<div class="col-md-12">
					<label class="control-label">Selecionar nova Capa:</label>
					<input class="file-input" type="file" name="filename" placeholder="Imagem da Categoria" />
				</div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-12">
					<label class="control-label">Descrição:</label>
					<textarea name="description" class="form-control">{{ $cat->description }}</textarea>
				</div>
			</div>
			<input type="hidden" name="id" value="{{ $cat->id }}" />
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="form-group col-md-12 text-center">
				<input type="submit" value="Alterar Categoria" class="btn btn-success center-block">
			</div>
		</form>		
	</div>
@endsection
@section('js')
	<!-- <script src="{{-- asset('js/jquery.form.min.js') --}}"></script> -->
	<script type="text/javascript">
		// $(document).ready(function(){

	 //     	$('#imagem').live('change',function(){
	 //         $('#visualizar').html('Enviando...');
	 //         $('#formulario').ajaxForm({
	 //            target:'#visualizar' 
	 //         }).submit();
	 //     	});
		// });
	</script>
@endsection