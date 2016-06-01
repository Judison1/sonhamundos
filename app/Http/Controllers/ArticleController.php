<?php

/**
* 
*/
namespace App\Http\Controllers;
use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function getCadastro()
	{
		$cats = Category::all();
		return view('articles.register', ['cats' => $cats]);
	}
	public function postCadastro(Request $request)
	{
		$this->validate($request, [
        'title' 		=> 'required|max:255',
        'synthesis' 	=> 'required|max:255',
        'content' 	=> 'required'
    	]);

    	$article = new Article;
    	$article->title 		= $request->input('title');
    	$article->synthesis 	= $request->input('synthesis');
    	$article->content 	= $request->input('content');
    	$article->path 	= 'default';
    	$article->filename 	= '1.jpg';
    	echo $article->save();
	}
}