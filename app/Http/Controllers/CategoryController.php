<?php

/**
* 
*/
namespace App\Http\Controllers;
use App\Article;
use App\Category;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function getCadastro()
	{
		return view('category.register');
	}
	public function postCadastro(Request $request)
	{
		$this->validate($request, [
        'name' => 'required|unique:category|max:255'
    	]);

		$name = $request->input('name');
		$description = $request->input('description');

		if($request->hasfile('filename')){

			$file = $request->file('filename');
			$path = public_path('img/category');
			$filename = $name . '.' .  $file->getClientOriginalExtension();

			if($file->isValid()){

				$file->move($path, $filename);
				
				if(!file_exists($path . "/" . $filename)){

					return back()->with('errors','Arquivo não foi salvo!');

				} else {

					$cat = new Category;
					$cat->name = $name;
					$cat->description = $description;
					$cat->filename = $filename;
					$cat->save();

					return redirect()->route('category.list')->with('success', "Categoria $name cadastrada com sucesso!");
				}
			} else{
				return back()->with('errors','Arquivo não é válido!');
			}
		} else {
			return back()->with('errors', 'Erro ao enviar o arquivo.');
		}
	}

	public function getIndex()
	{
		$cats = Category::paginate(15);
		return view('category.list', ['cats' => $cats]);
	}

	public function getAlterar($id)
	{
		$cat = Category::find($id);
		return view('category.update', ['cat' => $cat]);
	}
	public function postAlterar(Request $request){
		$id = $request->input('id');
		$cat = Category::find($id);
		$name = $request->input('name');
		$description = $request->input('description');
		$cat->description = $description;
		if($cat->name == $name){
			if($request->hasfile('filename')){
				$file = $request->file('filename');
				if($this->saveFile($file, $name)){
					$cat->filename = $name . '.' .  $file->getClientOriginalExtension();
				} 
			}
		} else {
			$this->validate($request, [
	        'name' => 'required|unique:category|max:255'
	    	]);
	    	$cat->name = $name;
	    	if($request->hasfile('filename')){
				$file = $request->file('filename');
				if($this->saveFile($file, $name)){
					unlink(public_path('img/category') . '/' . $cat->filename);
					$cat->filename = $name . '.' .  $file->getClientOriginalExtension();
				} 
			}
		}
		$cat->save();
		return redirect()->route('category.list')->with('success', "Categoria $name alterada com sucesso!");
	}

	public function deleteDeletar(Request $request)
	{
		$id = $request->input('id');
		$cat = Category::find($id);
		$cat->delete();
		DB::table('category_article')
			->where('category_id', '=', $id)
			->delete();
		
		if(!empty($cat->deleted_at))
			return response()->json("Categoria $cat->name deletada com sucesso!");
	}
	public function saveFile($file, $name)
	{
		$path = public_path('img/category');
		$filename = $name . '.' .  $file->getClientOriginalExtension();

		if($file->isValid()){

			$file->move($path, $filename);
			
			if(!file_exists($path . "/" . $filename)){

				$res = false;

			} else {
				$res = true;
			}
		} else{
			$res = false;
		}
		return $res;
	}
}