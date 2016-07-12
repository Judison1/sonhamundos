@if($indicator == 0)
	<div class="item active">
@else
	<div class="item">
@endif
		<a href="{{ route('public.view', ['title' => str_slug($art->title), 'id' => $art->id ]) }}">
	      	
	      @if(isset($art->synthesis))
	      	<img src="{{ asset('img/'.$art->path.'/'.$art->filename) }}" alt="{{ $art->title }}" width="100%">
	      	<div class="carousel-caption">
	      		<h3>{{ $art->title }}</h3>
	      		<span>{{ substr($art->synthesis, 0, 150) }}...</span>
	      	</div>
	      @else
	      	<img src="{{ asset('img/'.$art->path.'/thumbnail/'.$art->filename) }}" alt="{{ $art->title }}" width="100%">
	      	<div class="carousel-caption">
	      		<h4>{{ $art->title }}</h4>
	      	</div>
	      @endif
	     
	   </a>
   </div>