@extends('layouts.admin')
	@section('title')
		Cadastro de Usuário
	@stop
	@section('buttom')
		<a href="/admin/usuario" class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span> Lista de Usuários</a>
	@stop
	@section('container')
			@include('_success')
	<!-- 		@include('_errors')
			@include('_error') -->
		<form method="post" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-sm-2">Nome:</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="nome" placeholder="Nome Completo" required />
				</div>
			</div>
		
			<div class="form-group">
				<label class="control-label col-sm-2">Email:</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="email" placeholder="Email" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Foto de Perfil:</label>
				<div class="col-sm-5">
					<input class="form-control" type="file" name="foto" accept="image/x-png,image/gif,image/jpeg" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Descrição: </label>
				<div class="col-sm-5">
					<textarea class="form-control" name="descricao"></textarea>
				</div>
				<small class="text-warning">* Essas descrição vai aparecer na apresentação da página de autor!</small>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Senha: <small class="text-danger">(Mínimo 6 dígitos)</small></label>
				<div class="col-sm-5">
					<input class="form-control" type="password" name="senha" placeholder="Senha" required/>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Confirmar Senha:</label>
				<div class="col-sm-5">
					<input class="form-control" type="password" name="confirmarsenha" placeholder="Confirme a senha" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Escolha o Nível de Acesso:</label>
				<div class="col-sm-5">
					<div class="btn-group" data-toggle="buttons">
						@if($permission == "Desenvolvedor")
							@foreach($pers as $p)
								@if($p->name != "Desenvolvedor")
								<label class="btn btn-default">
							    	<input type="radio" name="nivel" autocomplete="off" value="{{ $p->id }}"> {{ $p->name }}
							  	</label>
							  	@endif
							@endforeach
						@elseif($permission == "Administrador")
							@foreach($pers as $p)
								@if($p->name != "Desenvolvedor" and $p->name != "Administrador")
								<label class="btn btn-default">
							    	<input type="radio" name="nivel" autocomplete="off" value="{{ $p->id }}"> {{ $p->name }}
							  	</label>
							  	@endif
							@endforeach

						@elseif($permission == "Supervisor")
							@foreach($pers as $p)
								@if($p->name != "Desenvolvedor" and $p->name != "Administrador" and $p->name != "Supervisor")
								<label class="btn btn-default">
							    	<input type="radio" name="nivel" autocomplete="off" value="{{ $p->id }}"> {{ $p->name }}
							  	</label>
							  	@endif
							@endforeach
						@endif
					</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      		<button type="submit" class="btn btn-primary submit">Cadastrar</button>
			      		<a href="javascript:history.go(0);" class="btn btn-default">Limpar</a>
			    </div>
			 </div>
		</form>
	@stop
	@section('js')
		<script type="text/javascript" src="{{ asset('assets/js/validacao-usuario.js') }}"></script>
	@stop