<?php
namespace App\Http\Controllers;
use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\User;

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
			'categories'	=> $this->categories(),
			'authors'	    => $this->authors()
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
			'tags' => $tags,
			'mostViewed' => $this->mostViewed(),
			'categories'	=> $this->categories(),
            'authors'	    => $this->authors()
		);	
		return view('articles.view', $var);
	}

	public function author($title, $id)
	{
		# code...
	}

	public function mostViewed()
	{
		return Article::where('status', '=', 1)
			->orderBy('views', 'desc')
			->take(8)
			->get();
	}

	public function categories()
	{
		return Category::select('id','name','filename')
			->get();
	}

	public function authors()
	{
	  return User::select('id','name','avatar')
	      ->get();
	}

	public function category($title, $id)
	{

		$category = Category::find($id);

		$headlines = $category->articles()
			->select('id','title','filename','path')
			->where('headline', '=', 1)
			->where('status', '=', 1)
			->take(3)
			->get();

		$articles1 = $category->articles()
			->select('id','title','filename','path')
			->where('headline', '=',0)
			->where('status', '=', 1)
			->take(2)
			->get();
		$articles2 = $category->articles()
			->select('id','title','filename','path')
			->where('headline', '=',0)
			->where('status', '=', 1)
			->skip(2)
			->take(3)
			->get();

		$articles =$category->articles()
			->select('id','title','synthesis','filename','path', 'views')
			->where('status', '=', 1)
			->orderBy('updated_at','DESC')
			->paginate(15);

		
		$var = array(
			'category'	=>	$category,
			'newHeadlines' => $headlines,
			'newArticles1'	=> $articles1,
			'newArticles2'	=> $articles2,
			'articles'	=> $articles,

			'mostViewed'	=> $this->mostViewed(),
			'categories'	=> $this->categories(),
			'authors'	   => $this->authors()
		);

		return view('category.articles', $var);
	}

}