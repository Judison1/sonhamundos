
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @for($indicator = 0; $indicator < $newArticles1->count(); $indicator++)
      @include('articles._indicators')
    @endfor
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @foreach($newArticles1 as $art)
      <a href="{{ route('articles.view', ['title' => str_slug($art->title), 'id' => $art->id ]) }}">

        @include('articles_inner')

      </a>
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
