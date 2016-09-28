@extends('layouts.admin')
@section('title', 'Lista de Artigos')

@section('button')
	<a href="{{ route('article.register') }}" class="btn btn-success pull-right">Cadastrar</a>
@endsection

@section('container')
	<div>

		<table class="table table-responsive">

			<thead>
				<th width="5%">cod</th>
				<th width="35%">Título</th>
				<th width="15%">Status</th>
				<th width="15%">Manchete</th>
				<th width="30%">Ações</th>
			</thead>

			<tbody>
				@foreach($articles as $article)
					@if($article->status == true)
					<tr data-id="{{$article->id}}" class="success">
					@else
					<tr data-id="{{$article->id}}"  class="danger">
					@endif
						<td>{{ $article->id }}</td>
						<td>
							<a href="{{ route('public.view', ['title' => str_slug($article->title), 'id' => $article->id ]) }}" target="_blank">
								{{ $article->title }}
							</a>
						</td>
						<td>
							<div class="btn-group btn-group-justified" role="group" aria-label="...">
								@if($article->status == true)
								<div class="btn-group selected" role="group">
								  	<button type="button" class="btn btn-success btn-xs btn-status" data-value="1">Ativo</button>
								</div>
								<div class="btn-group" role="group">
								  	<button type="button" class="btn btn-default btn-xs btn-status" data-value="0">Inativo</button>
								</div>
								@else
								<div class="btn-group" role="group">
								  	<button type="button" class="btn btn-default btn-xs btn-status" data-value="1">Ativo</button>
								</div>
								<div class="btn-group selected" role="group">
								  <button type="button" class="btn btn-success btn-xs btn-status" data-value="0">Inativo</button>
								</div>
								@endif
							</div>
						</td>
						<td>
							<div class="btn-group btn-group-justified" role="group" aria-label="...">
								@if($article->headline == true)
								<div class="btn-group selected" role="group">
								  	<button type="button" class="btn btn-success btn-xs btn-headline" data-value="1">Sim</button>
								</div>
								<div class="btn-group" role="group">
								  	<button type="button" class="btn btn-default btn-xs btn-headline" data-value="0">Não</button>
								</div>
								@else
								<div class="btn-group" role="group">
								  	<button type="button" class="btn btn-default btn-xs btn-headline" data-value="1">Sim</button>
								</div>
								<div class="btn-group selected" role="group">
								  <button type="button" class="btn btn-success btn-xs btn-headline" data-value="0">Não</button>
								</div>
								@endif
							</div>							

						</td>
						<td>
							<div class="btn-group btn-group-justified" role="group" aria-label="...">
								<div class="btn-group" role="group">
								  <a href="{{ route('article.edit', ['id' => $article->id]) }}" type="button" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil"></i> Info</a>
								</div>
								<div class="btn-group" role="group">
								  <a href="{{ route('article.edit.content', ['id' => $article->id]) }}" type="button" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-pencil"></i> Conteúdo</a>
								</div>
								<div class="btn-group" role="group">
								  <button type="button" class="btn btn-danger btn-xs btn-remove"><i class="glyphicon glyphicon-trash"></i> Remover</button>
								</div>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@if($articles->isEmpty())
			<div class="alert alert-warning" role="alert">Nenhum artigo cadastrado!</div>
		@endif
		{!! $articles->links() !!}
	</div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/stacktable.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/stacktable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/btnToggle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/remove.js') }}" type="text/javascript"></script>
<script>
  	$(document).ready(function(){
  		$('.table-responsive').cardtable();

  		$('.btn-status').click(function() {
  			var btn_status = $(this);
  			var url = "{{ route('article.edit.status') }}";
  			
  			btnToggle(btn_status, url, true);
  			
  		});

  		$('.btn-headline').click(function() {
  			var btn_status = $(this);
  			var url = "{{ route('article.edit.headline') }}";
  			
  			btnToggle(btn_status, url, false);
  		});

  		$('.btn-remove').click(function() {
  			var token = "{{ csrf_token() }}";
  			var route = "{{ route('article.delete') }}"
  			removeElement($(this), token, route);
  		});
  	});

  	
  
</script>
@endsection