@section('titulo')
	Edição do Usuário : {{ $usuario->nome }}
@stop
@section('buttom')
	<a href="/admin/usuario" class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span> Lista de Usuários</a>
@stop
@section('conteudo')
	<form method="post" class="form-horizontal">
		@include('admin._errors')
		@include('admin._success')
		<div class="form-group">
			<label class="control-label col-sm-2">Nome:</label>
			<div class="col-sm-5">
				<input class="form-control" type="text" name="nome" placeholder="Nome Completo" value="{{ $usuario->nome }}" required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Username:</label>
			<div class="col-sm-5">
				<input class="form-control" type="text" name="login" placeholder="Nome de Usuário" value="{{ $usuario->login }}" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Email:</label>
			<div class="col-sm-5">
				<input class="form-control" type="email" name="email" placeholder="Email" value="{{ $usuario->email }}" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Alterar Senha:</label>
			<div class="col-sm-5">
				<a href="#alterar-senha" class="btn-senha btn btn-default">Alterar Senha</a>
			</div>
		</div>
		
		<div class="div-senha">
			@if (Auth::user()->nivel != "Administrador")
				<div class="form-group">
					<label class="control-label col-sm-2">Senha:</label>
					<div class="col-sm-5">
						<input class="form-control" type="password" name="antigaSenha" placeholder="Senha"/>
					</div>
				</div>
			@endif
			<div class="form-group">
				<label class="control-label col-sm-2">Nova Senha:</label>
				<div class="col-sm-5">
					<input class="form-control" type="password" name="novaSenha" placeholder="Nova Senha"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Confirmar Nova Senha:</label>
				<div class="col-sm-5">
					<input class="form-control" type="password" name="csenha" placeholder="Confirme a Nova Senha"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Nível de Acesso:</label>
			<div class="col-sm-5">
				<div class="btn-group" data-toggle="buttons">
				@if (Auth::user()->nivel  == 'Administrador' and $perfil == false)
			  		@if($usuario->nivel == "Master")
				  		<label class="btn btn-default active">
				    		<input type="radio" name="nivel" autocomplete="off" value="2" checked> Master
				    	</label>
			    	@else
				    	<label class="btn btn-default">
				    		<input type="radio" name="nivel" autocomplete="off" value="2"> Master
				    	</label>
			    	@endif
	
			  		@if($usuario->nivel == "Padrão")
				  		<label class="btn btn-default active">
				    		<input type="radio" name="nivel" autocomplete="off" value="3" checked> Padrão
				    	</label>
			    	@else
			    	 	<label class="btn btn-default">
			    			<input type="radio" name="nivel" autocomplete="off" value="3"> Padrão
			    		</label>
			    	@endif
				@elseif(Auth::user()->nivel == 'Master' and $perfil == false)
				  	<label class="btn btn-default active">
				    	<input type="radio" name="nivel" autocomplete="off" value="3" checked> Padrão
				  	</label>
				@elseif($perfil == true)
					@if (Auth::user()->nivel  == 'Administrador')
					<label class="btn btn-default active">
				    	<input type="radio" name="nivel" autocomplete="off" value="1" checked> Administrador
				  	</label>
				  	@elseif(Auth::user()->nivel == 'Master')
				  		<label class="btn btn-default active">
				    		<input type="radio" name="nivel" autocomplete="off" value="2" checked> Master
				  		</label>
				  	@else
				  		<label class="btn btn-default active">
				    		<input type="radio" name="nivel" autocomplete="off" value="3" checked> Padrão
				  		</label>
				  	@endif
				@endif

				</div>
				@if(Auth::user()->nivel == 'Master')
					<a style="margin-left:10px;" href="#" class="info" data-toggle="popover" title="Informação" data-content="Sua permissão pode apenas cadastrar usuário com nível padrão!"><span class="text-danger glyphicon glyphicon-exclamation-sign"></span></a>
				@endif
				
			</div>
		</div>
		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-success submit">Alterar</button>
		      		<a href="javascript:history.back(1);" class="btn btn-danger">Cancelar</a>
		    </div>
		 </div>
	</form>
@stop
@section('js'):
	<!--<script type="text/javascript" src="{{ asset('assets/js/validacao-edit-usuario.js') }}"></script>-->
	<script type="text/javascript">
		$(document).ready(function() {
			var div = $('.div-senha');
				div.hide();
			$('.btn-senha').click(function() {
				div.slideToggle();
			});
		});
		//$('.alert').alert('close');
		
	</script>
		
@stop