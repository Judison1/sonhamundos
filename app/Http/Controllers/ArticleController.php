<?php

/**
* 
*/
namespace App\Http\Controllers;
use DB;
use Auth;
use App\CategoryArticle;

use App\Article;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;

class ArticleController extends Controller
{

   public function getIndex()
   {
      $articles = Article::select('articles.id','articles.title','articles.headline', 'articles.status','users.name')
         ->leftJoin('users', 'users.id', '=', 'articles.user_id')
         ->orderBy('articles.updated_at', 'DESC')
         ->paginate(15);
      return view('articles.list', ['articles' => $articles]);
   }

	public function getCadastro()
	{
		$cats = Category::all();
      $tags = Tag::all();
		return view('articles.register', ['cats' => $cats, 'tags' => $tags]);
	}

	public function postCadastro(Request $request)
	{
		$this->validate($request, [
        'title' 	    => 'required|max:255',
        'categories' 	=> 'required',
        'filename'      => 'required',
    	]);
        
    	$article = new Article;
    	$article->title 	= $request->input('title');
        $article->user_id = Auth::user()->id;
    	$article->synthesis   = "";
    	$article->content     = "";

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
         // tags
         if(is_array($request->input('tags'))){
            $tags = new TagController($request->input('tags'));
            $tags->separate();
            $tags->insert();
            $tags->setArticleId($article->id);
            $tags->setAddTags();
            $tags->insertArticleTag();
         }
         // upload and save photo
         if(!($request->hasFile('filename')))
            return back()->with('errors', 'filename não está na requisição');

         $fileRequest = $request->file('filename');
         $name = $article->id . '-' . str_slug($article->title);
         $path = public_path('img/articles');

         $File = new FileController($name, $path, $fileRequest);

         if($File->validation(['jpeg','jpg','png','gif'])) {

            if($File->save(720)) {

               $article->path       =  'articles';
               $article->filename   =  $File->getFilename();
               $article->save();

               return redirect()->route('article.edit',['id'=> $article->id]);

            } else
               return back()->with('errors',"Não foi possível salvar o arquivo!");

         } else
            return back()->with('errors',"Formato invalido ou o arquivo não existe!");

        }
	}

   public function getEditar($id)
   {
      $article = Article::find($id);
      $categories = Category::all();
      $cats = $article->categories;
      $tags = Tag::all();
      $articleTags = $article->tags;

      $newCats = array();
      foreach ($categories as $cat) {

         $check = false;
         foreach ($cats as $c) {
            if($cat->id == $c->id){
               $check = true;
            }
         }

         if($check) {

            $newCats[] = array(
               'id'  =>  $cat->id,
               'name' => $cat->name,
               'status' => 'selected="selected"'
            );

         } else {

            $newCats[] = array(
               'id'  =>  $cat->id,
               'name' => $cat->name,
               'status' => ''
            );
         }

      }

      $newTags = array();
      foreach ($tags as $tag) {

         $check = false;
         foreach ($articleTags as $at) {
            if($tag->id == $at->id){
               $check = true;
            }
         }

         if($check) {

            $newTags[] = array(
               'id'  =>  $tag->id,
               'name' => $tag->name,
               'status' => 'selected="selected"'
            );

         } else {

            $newTags[] = array(
               'id'  =>  $tag->id,
               'name' => $tag->name,
               'status' => ''
            );
         }

      }
      
      return view('articles.edit', [
         'article' => $article, 
         'categories' => $newCats, 
         'tags' => $newTags
      ]);
   }

   public function postEditar(Request $request, $id)
   {
      $this->validate($request, [
         'title'       => 'required|max:255',
         'categories'  => 'required',
      ]);
        
      $article = Article::find($id);
      $article->title  = $request->input('title');

      if($article->save()){
         // categories
         $categories = array();
         foreach ($request->input('categories') as $category) {
            $categories[] = array(
               'article_id'   => $article->id,
               'category_id'  => $category
            );
         }

         DB::table('category_article')->where('article_id','==', $article->id)->delete();
         
         DB::table('category_article')->insert($categories);

         if(is_array($request->input('tags'))){

            $tags = new TagController($request->input('tags'));
            $tags->separate();
            $tags->insert();
            $tags->setArticleId($article->id);
            $tags->setAllArticleTags();
            $tags->setAddRemoved();
            $tags->remove();
            $tags->insertArticleTag();

         } else {

            TagController::removeAllTagsArticle($article->id);

         }

         // Salvar imagem
         if($request->hasfile('filename')) {

            $fileRequest = $request->file('filename');
            $name = $article->id . '-' . str_slug($article->title);
            $path = public_path('img/articles');

            $File = new FileController($name, $path, $fileRequest);
            
            if($File->validation(['jpeg','jpg','png','gif'])) {

               if($File->save(920)) {
                     
                  $article->path       =  'articles';
                  $article->filename   =  $File->getFilename();
                  $article->save();

                  return redirect()->route('article.edit',['id'=> $article->id]);

               } else 
                  return back()->with('errors',"Não foi possível salvar o arquivo!");
            } else 
               return back()->with('errors',"Formato invalido ou o arquivo não existe!");
            
         } else {

            $img = $request->input('img');
            
            $directory = public_path("img/$article->path/$article->filename");

            $files = new FileController($directory);
            $files->saveImageBase64($img);
            $files->save(320, true);

         }
         return redirect()->route('article.edit.content', ['id' => $id]);
      }
   }

   public function getEditarConteudo($id)
   {
      $article = Article::find($id);
      
      return view('articles.edit_content', ['article' => $article]);
   }

   public function postEditarConteudo(Request $request, $id)
   {

      $article = Article::find($id);

      $this->validate($request, [
        'synthesis' => 'required|max:255',
        'content'   => 'required'
      ]);

      $article->synthesis = $request->input('synthesis');
      $article->content   = $request->input('content');
      if($request->input('publish') == 1) {
        $article->status = true;
      }
      if($article->save()) {
        return redirect()->route('article.list')->with('success',"Artigo $article->title foi salvo com sucesso!");
      } else {
        return back()->with('errors', "Erro ao salvar artigo!");
      }
   }

   public function getAlterarStatus($id, $status)
   {
      $article = Article::find($id);
      $article->status = $status;
     
      if($article->save()) {
         return "success";
      } else {
         return "error";
      }
   }

   public function getAlterarManchete($id, $manchete)
   {
      $article = Article::find($id);
      $article->headline = $manchete;
     
      if($article->save()) {
         return "success";
      } else {
         return "error";
      }
   }

   public function deleteRemover(Request $request)
   {
      
      $id = $request->input('id');

      $article = Article::find($id);
      $title = $article->title;
      
      if($article->delete()) {
         $response = array(
            'result' => true,
            'mensage' => "O artigo $title foi removido com sucesso!"
         );
      } else {
         $response = array(
            'result' => false,
            'mensage' => "Não foi possível remover o artigo: $title"
         );
      }
      return response()->json($response);
   }

}