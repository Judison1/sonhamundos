@section('title')
	Cadastro de Usuário
@stop
@section('buttom')
	<a href="/admin/usuario" class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span> Lista de Usuários</a>
@stop
@section('container')
		@include('messages._success')
	<form method="post" class="form-horizontal">
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
			<label class="control-label col-sm-2">Senha:</label>
			<div class="col-sm-5">
				<input class="form-control" type="password" name="senha" placeholder="Senha" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Confirmar Senha:</label>
			<div class="col-sm-5">
				<input class="form-control" type="password" name="csenha" placeholder="Confirme a senha" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Nível de Acesso:</label>
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