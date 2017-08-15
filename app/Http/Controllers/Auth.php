<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Input;
use Hash;

class Auth extends Controller
{
    public function __construct(){
        $this->middleware('allowsPages', ['only' => 'register']);
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function checklogin(){

		if(Session::has('user')){
			$user_id = Session::get('user');
			$user = User::where('doc_id',$user_id)->first();
			// if ($user->module1 == "Yes" && $user->status == "Active") {
			// 	return redirect('/deskpad');
			// }
			// elseif ($user->module2 == "Yes" && $user->status2 == "Active") {
			// 	return redirect('/operations');
			// }
			// elseif ($user->module3 == "Yes" && $user->status3 == "Active") {
			// 	return redirect('/accounting');
			// }
			// elseif ($user->module6 == "Yes" && $user->status6 == "Active") {
			// 	return redirect('/property');
			// }
			// else{
			// 	Session::flush();
			// 	return redirect()->action('Auth@checklogin');
			// }
			return redirect('/myinfo');
		}
		else{
			return view('welcome');
		} 
	}

	public function getlogin(Request $request){
		
		$user = $request->input('username');
		$pass = $request->input('password');
		$auth = User::where('username', $user)->first();
		if( count($auth) > 0 && $auth->password != ''){
			if (Hash::check($pass, $auth->password)) {
				Session::put('user', $auth->doc_id);
				Session::put('adminpassword', $pass);
				Session::save();
				
				$user_id = Session::get('user');
				$user = User::where('doc_id',$user_id)->first();
				if ($user->id == 1) {
					return redirect('/myinfo');
				}
				else{
					return redirect('/')->with('error','Inactive Account');
				}
			}
			else{
				return redirect('/')->with('error','Invalid Password');
			}
		}
		else{
			return redirect('/')->with('error','Invalid Acccount');
		}
	}

	public function logout(){
		Session::flush();
		return redirect()->action('Auth@checklogin');
	}

}
