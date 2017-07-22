@extends('layouts.default')

@section('title', $author->name)
@section('container-fluid')
    <section class="category-info row">

        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src='{{ asset("img/users/$author->avatar") }}' class="category-img img-circle" data-adaptive-background data-ab-parent='.category-info'>
                    </div>
                    <div class="col-md-7 col-md-offset-1">
                        <div class="row">
                            <h1 class='text'>{{ $author->name }}</h1>
                            <p>{{ $author->description }}</p>
                        </div>
                        <div class="row">
                            <span>Quantidade de artigos: {{ $qtd_articles }}</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('container')

    <section class="row articles-destaques ">
        {{-- Principais Artigos --}}
        <h2 class="col-md-12 text-center section-title">Principais Artigos</h2>

        {{-- Manchetes --}}
        <div class="col-xs-12 col-md-8">

            <div id="carousel_news_headlines" class="carousel slide" data-ride="carousel">
                <?php $name = "_news_headlines"?>
                @include('articles._news_headlines')
            </div>

        </div>

        {{-- Mais Recentes --}}
        <div class="col-xs-12 col-md-4">
            <div class="row">

                <div class="col-xs-12">
                    <!-- <h3>Principais Artigos</h3> -->
                    <div id="carousel_news_articles_1" class="carousel slide" data-ride="carousel">
                        <?php $name = "_news_articles_1"?>
                        @include('articles._news_articles_1')
                    </div>

                </div>

                <div class="col-xs-12">
                    <!-- <h3>Principais Artigos</h3> -->
                    <div id="carousel_news_articles_2" class="carousel slide" data-ride="carousel">
                        <?php $name = "_news_articles_2"?>
                        @include('articles._news_articles_2')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="container-fluid background-diff">
    <img src='{{ asset("img/users/$author->avatar") }}' style="display:none" data-adaptive-background data-ab-parent='.background-diff'>
        <section class="container">
            {{-- Mais visualizados --}}
            <div class="col-xs-12 most-viewed">
                <h2 class="text-center section-title">Mais visualizados</h2>
                <div class="row">

                    @foreach($mostViewed as $art)
                        <div class="col-xs-12 col-sm-4 col-md-3 box-art">
                            @include('articles._article')
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
</div>
<div class="container">
    <!-- Todos os artigos -->
    {{-- Todos os Artigos --}}
    <section class="col-md-12 articles-all">
        <div class="row">

            <h2 class="section-title text-center">Todos os Artigos</h2>
            @foreach($articles as $art)
                <div class="col-xs-12 col-sm-6 col-md-4 box-art">
                    @include('articles._article')
                </div>
            @endforeach

        </div>
        {{-- Paginação --}}
        {{ $articles->links() }}
    </section>

@endsection

@section('js')
    <script src="{{ asset('js/jquery.adaptive-backgrounds.js') }}"></script>
    <script type="text/javascript">
        $.adaptiveBackground.run({
                normalizeTextColor: true,
                exclude: [ 'rgb(0,0,0)' ]
            });
        $(document).ready(function(){
            
            $('#carousel_news_headlines').carousel({
                interval: 5000
            });
            $('#carousel_news_articles_1').carousel({
                interval: 4000
            });
            $('#carousel_news_articles_2').carousel({
                interval: 2500
            });
        });
    </script>
@endsection