<?php

/**
* 
*/
namespace App\Http\Controllers;
use DB;
use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;

class ArticleController extends Controller
{

   public function getIndex()
   {
      $articles = Article::select('articles.id','articles.title','articles.headline', 'articles.status','users.name')
         ->leftJoin('users', 'users.id', '=', 'articles.user_id')
         ->paginate(15);
      return view('articles.list', ['articles' => $articles]);
   }

	public function getCadastro()
	{
		$cats = Category::all();
		return view('articles.register', ['cats' => $cats]);
	}
	public function postCadastro(Request $request)
	{
		$this->validate($request, [
        'title' 	    => 'required|max:255',
        'synthesis'     => 'required|max:255',
        'categories' 	=> 'required',
        'filename'      => 'required',
        'content' 	    => 'required'
    	]);
        
        

    	$article = new Article;
    	$article->title 		= $request->input('title');
    	$article->synthesis 	= $request->input('synthesis');
    	$article->content 	= $request->input('content');

    	if($article->save()){
         // categories
         $categories = array();
         foreach ($request->input('categories') as $category) {
           $categories[] = array(
               'article_id'   => $article->id,
               'category_id'  => $category
            );
         }
         DB::table('category_article')->insert($categories);

         // upload and save photo 
            if(!($request->hasFile('filename')))
                return back()->with('errors', 'filename não está na requisição');

            $fileRequest = $request->file('filename');
            $name = $article->id . '-' . str_slug($article->title);
            $path = public_path('img/articles');

            $File = new FileController($name, $path, $fileRequest);
            
            $File->validation(['jpeg','jpg','png','gif']);

            if($File->save(920)) {
            
            $File->validation(['jpeg','jpg','png','gif']);
              $article->path       =  'articles';
               $article->filename   =  $File->getFilename();
               $article->save();

               return redirect()->route('article.editImg',['id'=> $article->id]);
            } else 
               return back()->with('errors',"Não foi possível salvar o arquivo!"); 
        }
	}

   public function getEditarImagem($id)
   {
      $article = Article::find($id);
      return view('articles.editImg', ['article' => $article]);
   }

   public function postEditarImagem(Request $request, $id)
   {
      $img = $request->input('img');
      $article = Article::find($id);
      $directory = public_path("img/$article->path/$article->filename");
      $files = new FileController($directory);
      $files->saveImageBase64($img);
      $files->save(320, true);
      return redirect()->route('article.list');
   }
}