<?php
namespace App\Controllers;

use Rakit\Validation\Validator;
use App\Models\User;

class AuthController extends Controller
{
	
	// 
	public function login()
	{
		$validator = new Validator;
		$validation = $validator->make($_POST, [
				'authmail' => 'required|email',
				'authpass' => 'required|min:1'
			]);
		$validation->validate();
		if ( $validation->fails()) {
			header('Location: /?auth=invalid_request');
			return false;
		}
		$email = $_POST['authmail'];
		$pass = $_POST['authpass'];
		$user = User::where('email', $email)->first();
		if ( !$user->id ) {
			header('Location: /?auth=invalid_email');
			return false;
		}
		if ( password_verify($pass, $user->password) ) {
			// good..
			$hash = md5(password_hash($user->id . $user->name .'_bg', PASSWORD_BCRYPT));
			$user->auth_key = $hash;
			$user->save();
			setcookie('authkey', $hash, time()+(3600*24*30), '/');
			header('Location: /?true');
			return true;
		} else {
			header('Location: /?auth=invalid_password');
			return false;
		}
	}
	
	
}
