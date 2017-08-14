<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;


function createUserArrayFromStdClass($stdClass) {
    $array = array(
        "id" => $stdClass->id,
        "login" => $stdClass->ulogin,
        "email" => $stdClass->email,
        "date" => array(
            "day" => $stdClass->born_day,
            "month" => $stdClass->born_month,
            "year" => $stdClass->born_year
        ),
        "name" => $stdClass->name,
        "api_key" => $stdClass->api_key
    );

    return $array;
}

class AuthController extends Controller
{
    public function index ( ) 
    {

    	$user = session()->get("user");


    	if(isset($user["name"]) AND isset($user["id"])) {

    		return redirect("profile/".$user["id"]);

    	}
    	else {
    		return view("auth", ["title" => "Вхід та реєстрація"]);
    	}

    }

    public function register ( Request $r ) 
    {
    	$login = $r->user_login;
    	$email = $r->user_email;
    	$password = $r->user_password;
    	$date = array(
    		"day" => $r->user_info_day,
    		"month" => $r->user_info_month,
    		"year" => $r->user_info_year
    	);
    	$name = $r->user_name;
    	$password = User::hash($password);
    	$api_key = md5(time().$email);

    	$users = DB::table("users")
    		->where("email", $email)
    		->orWhere("login", $login);

    	if(isset($users->id) AND isset($users->login)) {
    		print_r("User found!");
    	}
    	else {
    		$id = intval(0);
    		$id = DB::table("users")->insertGetId(
    				[
    					"ulogin" => $login,
    					"email" => $email,
    					"name"  => $name,
    					"password" => $password,
    					"api_key" => $api_key,
    					"born_day" => $date["day"],
    					"born_month" => $date["month"],
    					"born_year" => $date["year"],
    					"email_able" => 1,
    					"image" => null
    				]
    			);


    		session()->put("user", array(
    			"login" => $login,
    			"email" => $email,
    			"api_key" => $api_key,
    			"id" => $id,
    			"date" => $date,
    			"name" => $name
    		));

    		return redirect("profile/".$id);

    	}

    }

    public function login ( Request $r ) 
    {
        $login = $r->user_login;
        $password = $r->user_password;

        $login_error_message = "Логін або пароль введені не вірно!";

        $user = DB::table("users")
            ->where("ulogin", $login)
            ->orWhere("email", $login)
            ->first();

        if(isset($user->id) AND isset($user->email)) {

            $checkup = User::valid($password, $user->password);


            if($checkup == true) {
                session()->put("user", createUserArrayFromStdClass($user));

                return redirect("profile/".$user->id);  
            }

            else {
                return view("auth", ["login_error" => true, "login_error_message" => $login_error_message, "title" => "Вхід та реєстрація"]);
            }

            

        }

        else {

            return view("auth", ["login_error" => true, "login_error_message" => $login_error_message, "title" => "Вхід та реєстрація"]);

        }

    }



    public function logout ( Request $r ) {

        session()->forget("user");

        return redirect('/auth');


    }
}
