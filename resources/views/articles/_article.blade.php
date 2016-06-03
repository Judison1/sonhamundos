
	<a href="#{{-- route('articles.view', ['title' => str_slug($art->title), 'id' => $art->id ]) --}}">
		<img src="{{ asset('img/articles/' . $art->path . '/thumbnail/' . $art->filename) }}" alt="{{ $art->title }} " class="img-responsive">
		<h4>{{ $art->title }}</h4>
	</a>
