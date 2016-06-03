
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @for($indicator = 0; $indicator < $newArticles2->count(); $indicator++)
      @include('articles._indicators')
    @endfor
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php $indicator = 0; ?>
    @foreach($newArticles2 as $art)
        @include('articles._inner')
        <?php $indicator++; ?>
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel{{$name}}" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel{{$name}}" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
