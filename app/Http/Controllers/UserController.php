<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\User;
use App\Permission;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function index()
	{
		# code...
	}
	public function getAuthenticate(){
		return view('users.login');
	}
	public function authenticate(Request $request)
   {
    	$email = $request->input('email');
    	$password = $request->input('password');

      if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
         return redirect()->intended(route('article.list'));
         // echo 'pegou';
      } else{
      	// echo 'merda';
      	return back()->withErrors('error');
      }
   }
	public function onList()
	{
		$users = User::paginate(15);

		return view('user.onList', $users);
	}

	public function getRegistro(){
		$permission = Auth::user()
			->permission
			->name;
		$pers = Permission::all();
		$var = array(
			'permission' => $permission,
			'pers'	=> $pers
		);
		var_dump($var['permission']);
		return view('users.register', $var);
	}
	public function postRegistro(Request $request)
	{
		$this->validate($request, [
        	'nome' => 'required|max:255',
        	'email' => 'required|unique:users|max:255',
        	'foto' => 'required',
        	'senha' => 'required',
        	'confirmarsenha' => 'required|same:senha',
        	'nivel' => 'required',
    	]);
    	$user = new User();
    	$user->name = $request->input('nome');
    	$user->email = $request->input('email');
    	$user->password = bcrypt($request->input('senha'));
    	$user->description = $request->input('descricao');
    	$user->permission_id = $request->input('nivel');
    	if($user->save()){
    		if($request->hasfile('foto')){

				$fileRequest = $request->file('foto');
				$path = public_path('img/users');
				$filename = $user->id . '-' . str_slug($user->name);

				$file = new FileController($filename, $path, $fileRequest);

				if($file->validation(['jpeg','jpg','png','gif'])) {

					if($file->save(360)) {

						$user->avatar = $file->getFilename();

						if($user->save())
							echo 'user.edit';
							// return redirect()->route('user.edit',['id'=> $user->id]);
						else
							echo 'Erro ao guardar imagem.';
							// return back()->with('errors', 'Erro ao guardar imagem.');

					} else
						echo 'Não foi possivel salvar a imagem';
						// return back()->with('errors','Não foi possivel salvar a imagem');

				} else
					echo 'Formato inválido ou o arquivo não existe.';
					// return back()->with('errors','Formato inválido ou o arquivo não existe.');

			} else
				echo 'Erro ao enviar o arquivo.';
				// return back()->with('errors', 'Erro ao enviar o arquivo.');
    	} else 
    		echo 'Não foi possível salvar as informações.';
    		// return back()->with('errors', 'Não foi possível salvar as informações.');
	}

	public function getEditar($id)
	{
		# code...
	}
}