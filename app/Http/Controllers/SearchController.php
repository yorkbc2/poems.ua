<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Poem;

class SearchController extends Controller
{
    public function searchByQuery (Request $r) {

    	if(isset($_GET["query"])) {

    		$old = $_GET["query"];

    		$query = "%".$_GET["query"]."%";

    		// $poems_search = Poem::where([
    		// 	["title", "like", $query]
    		// ])->orWhere([
    		// 	["content", "like", $query]
    		// ])->get();

    		$poems_search = Poem::where(
    			[
    				["title", "like", $query]
    			]
    		)->get();

    		$users_search = User::where([
    			["name", "like", $query]
    		])->orWhere([
    			["ulogin", "like", $query]
    		])->get();

    		return view("etc.search", ["query" => $old, "users" => $users_search, "poems" => $poems_search]);

    	}

    }
}
