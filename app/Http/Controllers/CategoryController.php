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

		$cat = new Category;
		$cat->name = $name;
		$cat->description = $description;

		if($cat->save()){

			if($request->hasfile('filename')){

				$fileRequest = $request->file('filename');
				$path = public_path('img/category');
				$filename = $cat->id . '-' . str_slug($cat->name);

				$file = new FileController($filename, $path, $fileRequest);

				if($file->validation(['jpeg','jpg','png','gif'])) {

					if($file->save(920)) {

						$cat->filename = $file->getFilename();

						if($cat->save())
							return redirect()->route('category.edit',['id'=> $cat->id]);
						else
							return back()->with('errors', 'Erro ao guardar imagem.');

					} else
						return back()->with('errors','Não foi possivel salvar a imagem');

				} else
					return back()->with('errors','Formato inválido ou o arquivo não existe.');

			} else
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
		$name = $request->input('name');
		$description = $request->input('description');
		$imgBase64 = $request->input('img');

		$cat = Category::find($id);
		$cat->description = $description;

		
		if($cat->name != $name) {

			$this->validate($request, [
	        'name' => 'required|unique:category|max:255'
	    	]);
	    	$directory = public_path("img/category/$cat->filename");
	    	$temp = pathinfo($directory);
	    	$extension =  $path_parts['extension'];

	    	$filename = $cat->id . '-' . str_slug($name) . '.' .  $extension;

			rename($directory, public_path('img/category/' . $newfilename));

			$cat->name = $name;
	    	$cat->filename = $newfilename;

		}

		if($cat->save()) {

			if($request->hasfile('filename')){

				$fileRequest = $request->file('filename');
				$path = public_path('img/category');
				$filename = $cat->id . '-' . str_slug($cat->name);

				$file = new FileController($filename, $path, $fileRequest);

				if($file->validation(['jpeg','jpg','png','gif'])) {

					unlink($path . '/' . $cat->filename);

					if($file->save(920)) {

						$cat->filename = $file->getFilename();

						if($cat->save())
							return redirect()
								->route('category.edit',['id'=> $cat->id])
								->with('success', "Escolha a área de recorte da imagem.");
						else
							return back()->with('errors', 'Erro ao guardar imagem.');

					} else
						return back()->with('errors','Não foi possivel salvar a imagem');

				} else
					return back()->with('errors','Formato inválido ou o arquivo não existe.');

			} else {
				
				$directory = public_path("img/category/$cat->filename");
         	$file = new FileController($directory);
         	$file->saveImageBase64($imgBase64);

         	if($file->save(320, true))
         		return redirect()->route('category.list')->with('success', "Categoria $name alterada com sucesso!");
         	else
         		return back()->with('errors', 'Erro ao salvar o arquivo.');
         	
			}

		} else
			return back()->with('errors', 'Não foi possivel alterar a categoria.');

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