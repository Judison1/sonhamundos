@extends('layouts.admin')

@section('title', "Editando o Artigo:: $article->title")

@section('button')
	<a href="#{{-- route('articles.list') --}}" class="btn btn-default pull-right">Lista de Artigos</a>
@endsection

@section('container')
	<form id="form" method="POST">
		<div class="teste"></div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<input class="input-img" type="hidden" name="img">
		<a href="#form" class="result btn btn-success">Recortar</a href="#form">
	</form>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/croppie.css') }}">
@stop

@section('js')
	<script src="{{ asset('js/croppie.min.js') }} "></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
		var basic = $('.teste').croppie({
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