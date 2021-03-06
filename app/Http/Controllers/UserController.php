<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function getDashboard(){
		return view('dashboard');
	}

    public function postSignUp(Request $request){
		
		$email = $request['email'];
		$first_name = $request['first_name'];
		$password = bcrypt($request['password']);
		
		$user = new user();
		$user->email =  $email;
		$user->first_name = $first_name;
		$user->password = $password;
		
		$user->save();
		
		return redirect()->route('dashboard');
	}

	public function postSignIn(Request $request){
		
		if(Auth::attempt(['email' => $request['email'],'password' => $request['password']])){
			return redirect()->route('dashboard');
		}
		return redirect()->back();
	}
}

