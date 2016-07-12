
	<a href="{{ route('public.view', ['title' => str_slug($art->title), 'id' => $art->id ]) }}">
		<div class="row">
			<div class="box-art-views col-xs-offset-6 col-xs-6 text-right">{{ $art->views }} views</div>
		</div>
		<img src="{{ asset('img/' . $art->path . '/thumbnail/' . $art->filename) }}" alt="{{ $art->title }} " class="box-art-img">
		<h4 class="box-art-title">{{ $art->title }}</h4>
	</a>
