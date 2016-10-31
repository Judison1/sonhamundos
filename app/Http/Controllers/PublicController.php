<?php
namespace App\Http\Controllers;
use App\Article;
use App\Category;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
	public function index()
	{
		$headlines = Article::select('id','title','synthesis','filename','path')
			->where('headline', '=', 1)
			->where('status', '=', 1)
			->take(3)
			->get();
		$articles1 = Article::select('id','title','filename','path')
			->where('headline', '=',0)
			->where('status', '=', 1)
			->take(2)
			->get();
		$articles2 = Article::select('id','title','filename','path')
			->where('headline', '=',0)
			->where('status', '=', 1)
			->skip(2)
			->take(3)
			->get();

		$articles = Article::select('id','title','synthesis','filename','path', 'views')
			->where('status', '=', 1)
			->orderBy('updated_at','DESC')
			->paginate(15);

		
		$var = array(
			'newHeadlines' => $headlines,
			'newArticles1'	=> $articles1,
			'newArticles2'	=> $articles2,
			'articles'	=> $articles,

			'mostViewed'	=> $this->mostViewed(),
			'categories'	=> $this->categories()
		);

		return view('index', $var);

	}

	public function view($title, $id){
		$article = Article::find($id);
		$author = $article->user;
		$categories = $article->categories;
		$tags = $article->tags;
		$var = array(
			'article' => $article , 
			'author' => $author, 
			'articleCategories' => $categories,
			'mostViewed' => $this->mostViewed(),
			'categories'	=> $this->categories()
		);	
		return view('articles.view', $var);
	}

	public function category($title, $id)
	{
		# code...
	}
	public function author($title, $id)
	{
		# code...
	}

	public function mostViewed()
	{
		$articles = Article::where('status', '=', 1)
			->orderBy('views', 'desc')
			->take(8)
			->get();
		return $articles;
	}

	public function categories()
	{
		$categories = Category::select('id','name','filename')
			->get();
		return $categories;
	}
	
}