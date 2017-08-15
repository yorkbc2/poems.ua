<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Poem;
use App\User;

use App\Review;
use App\Star;

use App\Follower;

class PoemsController extends Controller
{
    public function indexPage (Request $r) {

        $last_poems = Poem::orderBy("id", "desc")->limit(10)->get();

        $best_authors = User::orderBy("followers", "desc")->limit(3)->get();

        return view("index", [
            "last_poems" => $last_poems,
            "best_authors" => $best_authors
        ]);

    }

    public function addView( Request $r )
    {
    	
    	if(session()->get("user")) {

    		$cats = Category::all();

    		return view("poems.add", ["title" => "Додати", "cats" => $cats]);

    	}

    	else {

    		return redirect("/auth");

    	}

    }

    public function addCategory( Request $r ) {
    	$title = $r->title;

    	$cat = Category::where("title", $title)
    		->first();

    	if(isset($cat->id) AND isset($cat->title)) {
    		echo json_encode(array(0));
    	}
    	else {
	    	$id = Category::insertGetId(
	    		["title" => $title]
	    	);

	    	echo json_encode(array(1, $id));
    	}


    }

    public function addPoem ( Request $r ) {

    	$title = $r->poem_title;
    	$content = $r->poem_content;
    	$category = $r->poem_category;
    	$image = $r->poem_image;

    	if($image != "") {
    		print_r("TODO :: IMAGE");
    	}
    	else {
    		$image = null;
    	}

    	$author = session()->get("user");

    	$author_id = $author["id"];
    	$author_name = $author["name"];

    	date_default_timezone_set("UTC");

    	$date = date("Y-m-d H:i:s");

    	$status = 1;

    	$id = Poem::insertGetId(
    		[
    			"title" => $title,
    			"content" => $content,
    			"category_id" => $category,
    			"author_name" => $author_name,
    			"author_id" => $author_id,
    			"status" => $status,
    			"date" => $date,
    			"image" => $image,
                "views" => 0,
                "stars" => 0
    		]
    	);

    	return view("poems.success",
    		["text" => "Ваша поема успішно додана ! Ви можете прочитати її по цьому посиланню: 
    		<a href='/poem/".$id."'>".$title."</a>"]);

    }

    public function getPoem ( Request $r, $id ) {
        $poem = Poem::where("id", $id)->first();
        $author = User::where("id", $poem->author_id)->first();

        $reviews = Review::where("poem_id", $id)
            ->orderBy("id", "desc")
            ->get();

        $isStared = Star::where([
            ["poem_id", $id],
            ["user_id", session()->get("user")["id"]]
        ])->first();

        if(isset($isStared->id)) {
            $isStared = true;
        }
        else {
            $isStared = false;
        }

        $category_name = Category::where("id", $poem->category_id)->first()->title;

        if(session()->get("user")) {
            if(session()->get("user")["id"] !== $poem->author_id) {
                Poem::where("id", $id)
                        ->increment("views");
            }
        }

        return view("poems.item", ["poem" => $poem, "category_name" => $category_name, "author_login" => $author->ulogin, "reviews" => $reviews, "stared" => $isStared]);

    }


    public function addReview ( Request $r ) {
        $content = $r->content;
        $id = $r->id;

        $user = session()->get("user");

        Review::insert(["content" => $content, 
                "poem_id" => $id,
                "author_id" => $user["id"],
                "author_name" => $user["name"],
                "author_login" => $user["login"],
                "content" => $content,
                "created_at" => date("Y-m-d H:i:s")
            ]);

        echo json_encode(array(
            "poem_id" => $id,
            "author_id" => $user["id"],
            "author_name" => $user["name"],
            "author_login" => $user["login"],
            "content" => $content
        ));

    }



    public function feed ( Request $r ) {

        if(session()->get("user")) {

            $user = session()->get("user");

            $followers = Follower::where("user", $user["id"])->get();

            $followers_id = [];

            for($i = 0; $i < count($followers) ; $i++) {

                array_push($followers_id, $followers[$i]["profile"]);

            }

            $categories = Category::all();

            $users = [];

            if(count($followers_id) > 0 ) {
                $users = User::where("id", $followers_id)->get();
            }
            else {
                $users = [];
            }


            return Poem::controlGet($followers_id, $categories, $users);


        }
        else {
            return redirect("auth");
        }

    }
}
