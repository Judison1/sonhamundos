@section('titulo')
	Lista de Usuário
@stop
@section('buttom')
	<a href="/admin/usuario/cadastro" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Cadastrar</a>
@stop
@section('conteudo')
	<table id="card-table" class="table">
  		<thead>
  			<tr>
  				<th width="5%"></th>
  				<th width="5%">Cod</th>
			    <th width="20%">Nome</th>
			    <th width="15%">Login</th>
			    <th width="20%">Email</th>
			    <th width="15%">Nível</th>
			  
			    <th width="20%">Ação</th>
  			</tr>
 		</thead> 
 		<tbody>
  			@foreach ($usuarios as $usuario)
  				<tr>
  					<td><input type="checkbox" name="check[]" value="{{ $usuario->id }}"></td>
  					<td>{{ $usuario->id }}</td>
  					<td>{{ $usuario->nome }}</td>
  					<td>{{ $usuario->login }}</td>
  					<td>{{ $usuario->email }}</td>
  					<td>{{ $usuario->nivel }}</td>
  				
  					<td>
  						<a href="/admin/usuario/alterar/{{ $usuario->id }}" class="btn btn-link">
			    			<span class="glyphicon glyphicon-edit"></span> Editar
			    		</a>	
			    		<a href="#apagar" class="btn btn-link remove text-danger" id="{{ $usuario->id }}">
			    			<span class="glyphicon glyphicon-trash text-danger" ></span>
			    			<span class="text-danger"> Apagar</span> 
			    		</a>
  					</td>
  				</tr>
  			@endforeach
 		</tbody>
 	</table>
 	<button class="btn btn-danger removerVarios"><i class="glyphicon glyphicon-trash"></i> Remover selecionados</button>
@stop
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin/stacktable.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin/tabela.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin/alertify.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/admin/themes/default.css') }}" />
@stop
@section('js')
	<script src="{{ asset('assets/js/stacktable.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/alertify.min.js') }}"></script>
	<script src="{{ asset('assets/js/usuario.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/remover-varios-usuario.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			 $('#card-table').cardtable({myClass:'stacktable small-only' });
		});
	</script>
@stop