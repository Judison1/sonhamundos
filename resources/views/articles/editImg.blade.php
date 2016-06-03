@extends('layouts.admin')

@section('title', "Editando o Artigo:: $article->title")

@section('button')
	<a href="#{{-- route('articles.list') --}}" class="btn btn-default pull-right">Lista de Artigos</a>
@endsection

@section('container')
	<form id="form" method="POST">
		<div class="teste"></div>
		<input class="input-img" type="hidden" name="img">
		<a href="#form" class="result btn btn-success">Recortar</a href="#form">
	</form>
@endsection

@section('js')
	<script src="croppie.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
		var basic = $('.teste').croppie({
		    viewport: {
		        width: 720,
		        height: 480
		    },
		    boundary: { width: 720, height: 480 },
		});
		basic.croppie('bind', {
		    url: {{ asset("img/$article->path/$article->filename") }},
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