<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Poem;
use App\Follower;
use App\Star;

class ProfileController extends Controller
{
    public function index ( Request $r, $id ) {
    	$user = session()->get("user");

    	$profile = DB::table("users")->where("id", $id)->first();

        $poems = DB::table("poems")->where("author_id", $id)->get();

        
        $star_poems = Star::where("user_id", $profile->id)->get();
        $star_poems_array = [];

        for($i = 0; $i < count($star_poems) ; $i++) {

            array_push($star_poems_array, $star_poems[$i]->poem_id);

        }
        
        if(count($star_poems_array) > 0) {
            $star_poems = Poem::where("id", $star_poems_array)->get();
        }
        else {
            $star_poems = [];
        }

        $isFollow = false;

        

    	if(isset($profile->id) AND isset($profile->name)) {
            if(isset($user["id"]) OR isset($user->id)) {

                if($user["id"] == $id) {
                    $following = DB::table("followers")->where("user", $user["id"])->get();
                    $followers = DB::table("followers")->where("profile", $user['id'])->get();
                    return view("profile", [
                        "isProfile" => true,
                        "profile" => $profile,
                        "title" => $profile->name,
                        "poems" => $poems,
                        "following" => $following,
                        "followers" => $followers,
                        "star_poems" => $star_poems
                    ]);
                }

                else {
                    $follows = DB::table("followers")->where([
                        ['profile', '=', $profile->id],
                        ["user", '=', $user["id"]]
                    ])->first();

                    if(isset($follows->id)) {
                        $isFollow = true;
                    }

                    $followers = Follower::where("profile", $profile->id)->get();


                    return view("profile", ["profile" => $profile, "title" => $profile->name,
                        "poems" => $poems, "isFollow" => $isFollow, "followers" => $followers,
                        "star_poems" => $star_poems]);
                }

            }
            else {
                return view("profile", ["profile" => $profile, "title" => $profile->name,
                        "poems" => $poems,
                        "star_poems" => $star_poems]);
            }
        }
        else {
            return view("profile", ["profile" => $profile, "title" => "Користувача не знайдено",
                        "poems" => $poems,
                        "star_poems" => $star_poems]);
        }
    }
}
