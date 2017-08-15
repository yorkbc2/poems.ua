<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follower;
use App\User;

class FollowingController extends Controller
{
    public function followNow( Request $r ) {

    	$profileID = $r->profile;
    	$userID = $r->user;

    	Follower::insert(["profile" => $profileID, "user" => $userID]);

    	$followers = Follower::where("profile", $profileID)->get();

        User::where('id', $profileID)->increment("followers");

        $followersCount = count($followers);

        echo $followersCount;

    }

    public function unFollowNow( Request $r ) {
        $profileID = $r->profile;
        $userID    = $r->user;

        Follower::where([
            ["user", "like", $userID],
            ["profile", "like", $profileID]
        ])->delete();

        $followers = Follower::where("profile", $profileID)->get();

        User::where('id', $profileID)->decrement("followers");

        $followersCount = count($followers);

        echo $followersCount;
    }

    public function myselfFollows ( Request $r ) {

    	$user = session()->get("user");

    	if(isset($user['id']) AND isset($user["login"])) {

    		$following = Follower::where("user", $user["id"])->get();

            $followinArray = [];

            for($i = 0; $i < count($following) ; $i++) {
                array_push($followinArray, $following[$i]->profile);
            }


            $following = User::whereIn("id", $followinArray)->get();

    		return view("profile.following", ["followers" => $following]);

    	}
    	else {
    		return redirect('auth');
    	}

    }

    public function getFollowsById (Request $r, $id) {

    	$profile = User::where("id", $id)->first();

    	$following = Follower::where("profile", $id)->get();

    	return view("profile.following", ["followers" => $following]);

    }
}
