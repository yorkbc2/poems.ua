<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{	
	public static function controlGet($followers, $categories, $users) {

		$user = session()->get("user");

		if(isset($_GET["category"])) {
			$poems = [];
			if(count($followers) > 0) {
				$poems = self::where([
					["author_id", $followers],
					["category_id", $_GET["category"]]
				])->get();
			}
			else {
				$poems = [];
			}

			$category_name = "";

			for($i = 0 ; $i < count($categories) ; $i++) {
				if($categories[$i]["id"] == $_GET["category"]) {
					$category_name = $categories[$i]["title"];
					break;
				}
			}

			return view("etc.feed", [
				"poems" => $poems,
				"categories" => $categories,
				"category_name" => $category_name,
				"users" => $users
			]);

		}
		else if (isset($_GET["author"])) {
			$poems = self::where("author_id", $_GET["author"])->get();

			return view("etc.feed", 
			[
				"poems" => $poems,
				"categories" => $categories,
				"users" => $users
			]);
		}
		else {
			$poems = [];
			if(count($followers) > 0) {
				$poems = self::where([
					["author_id", $followers],
					["category_id", $_GET["category"]]
				])->get();
			}
			else {
				$poems = [];
			}

			return view("etc.feed", 
			[
				"poems" => $poems,
				"categories" => $categories,
				"users" => $users
			]);
		}

	}
}
