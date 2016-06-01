@extends('layouts.admin')
@section('title', 'Lista de Categorias')

@section('button')
	<a href="{{ route('category.register') }}" class="btn btn-success pull-right">Cadastrar</a>
@endsection

@section('container')
	<div>
		<table class="table-responsive">
			<thead>
				<th width="10%">cod</th>
				<th width="25%">Nome</th>
				<th width="40%">Descrição</th>
				<th width="25%">Ações</th>
			</thead>
			<tbody>
				@foreach($cats as $cat)
					<tr data-id="{{$cat->id}}">
						<td>{{ $cat->id }}</td>
						<td>{{ $cat->name }}</td>
						<td>{{ $cat->description }}</td>
						<td>
							<div class="col-sm-12 col-md-6">
								<a href="{{ route('category.update', ['id' => $cat->id]) }}" class="btn btn-default">Alterar</a>
							</div>
							<div class="col-sm-12 col-md-6">
								<a href="#remove" class="btn btn-danger btn-remove ">Remover</a>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@if($cats->isEmpty())
			<div class="alert alert-warning" role="alert">Nenhuma categoria cadastrada!</div>
		@endif
		{!! $cats->links() !!}
	</div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/stacktable.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/stacktable.min.js') }}" type="text/javascript"></script>
<script>
  	$(document).ready(function(){
  		$('.table-responsive').cardtable();

  		$('.btn-remove').click(function() {
  			res = confirm("Deseja realmente deletar essa categoria?");
  			if(res == true) {

	  			var tr = $(this).parents('tr');
	  			var id = tr.data('id');
	  			var token = "{{ csrf_token() }}";

	  			$.ajax({
					url: "{{ route('category.delete') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {id: id, _token: token },
				})
				.done(function(msg) {
					tr.remove();
					alert(msg);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
  		});
  	});
</script>
@endsection