<?php
namespace App\Http\Controllers;
use App\Article;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
	public function index()
	{
		$headlines = Article::where('headline', '=', 1)
			->where('status', '=', 1)
			->take(3)
			->get();
		$articles1 = Article::where('headline', '=',0)
			->where('status', '=', 1)
			->take(3)
			->get();
		$articles2 = Article::where('headline', '=',0)
			->where('status', '=', 1)
			->skip(3)
			->take(3)
			->get();

		$articles = Article::where('headline', '=', 0)
			->where('status', '=', 1)
			->paginate(15);

		$most = $this->mostViewed();
		$var = array(
			'newHeadlines' => $headlines,
			'newArticles1'	=> $articles1,
			'newArticles2'	=> $articles2,
			'articles'	=> $articles,
			'mostViewed'	=> $most
		);

		return view('index', $var);

	}

	public function mostViewed()
	{
		$articles = Article::where('status', '=', 1)
			->orderBy('views', 'desc')
			->take(6)
			->get();
		return $articles;
	}
}