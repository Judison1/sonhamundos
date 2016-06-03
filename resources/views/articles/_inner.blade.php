@if($indicator == 0)
	<div class="item active">
@else
	<div class="item">
@endif
		<a href="#{{-- route('articles.view', ['title' => str_slug($art->title), 'id' => $art->id ]) --}}">
			<img src="{{ asset('img/articles/'.$art->path.'/'.$art->filename) }}" alt="{{ $art->title }}" class="img-responsive">
	      <div class="carousel-caption">
	      	{{ $art->title }}
	      </div>
	   </a>
   </div>