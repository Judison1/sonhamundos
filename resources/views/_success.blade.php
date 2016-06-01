@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible fade in" role="alert">
		<button class="close" aria-label="Close" data-dismiss="alert" type="button"><i class="glyphicon glyphicon-remove text-danger"></i></button>
			<strong>Atenção: </strong>{{ Session::get('success') }}
	</div>
@endif