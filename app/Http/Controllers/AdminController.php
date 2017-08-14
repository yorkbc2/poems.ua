<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function hashPassword ($password = "", $cost = 11) {
	$salt = substr(base64_encode(openssl_random_pseudo_bytes(17)), 0 , 22);

	$salt = str_replace("+", ".", $salt);

	$param = "$".implode('$', array(
		"2y",
		str_pad($cost, 2, "0", STR_PAD_LEFT),
		$salt
	));

	return crypt($password, $param);
}

function validatePassword($password, $hash) {
   return crypt($password, $hash) == $hash;
}

class AdminController extends Controller
{
    public function panel ( ) {

    	$admin = session()->get("admin");

    	if($admin === null) {
    		return redirect("admin/login");
    	}
    	else {
    		if(isset($admin["login"]) AND isset($admin["id"])) {
    			return view("admin");
    		}
    	}


    }


    public function login ( ) {

    	$admin = session()->get("admin");

    	if($admin === null) {
    		return view("login");
    	}
    	else {
    		if(isset($admin["login"]) AND isset($admin["id"])) {
    			return redirect('admin/panel');
    		}
    	}

    }

    public function auth ( Request $req ) {
    	$login = $req->user_login;

    	$password = $req->user_password;

    	$user = DB::table("admins")->where("login", $login)->first();

    	if(isset($user->password) AND isset($user->id)) {
    		if(validatePassword($password, $user->password)) {

    			$user = json_decode(json_encode($user), true);

    			session()->put("admin", $user);

    			print_r(session()->get("admin"));

    			return redirect('admin/panel');

    		}
    		else {
    			return view("login", ["error" => true, "error_message" => "Логін або пароль не вірні!"]);
    		}
    	}
    	else {
    		return view("login", ["error" => true, "error_message" => "Логін або пароль не вірні!"]);
    	}

    }


    public function logout ( Request $req ) {

        $req->session()->forget("admin");

        return redirect("/");

    }



}
