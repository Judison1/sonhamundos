<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\User;
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
         return redirect()->intended(route('admin.register'));
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

	public function getRegister(){
		$permission = Auth::user()
			->permission()
			->name;
		$pers = Permission::all();
		$var = array(
			'permission' => $permission,
			'pers'	=> $pers
		);
		return view('users.register', $var);
	}
}