@if($indicator == 0)
	<div class="item active">
@else
	<div class="item">
@endif
		<img src="{{ asset('img/articles/'.$art->path.'/'.$art->filename) }}" alt="{{ $art->title }}">
      <div class="carousel-caption">
      	{{ $art->title }}
      </div>
   </div>