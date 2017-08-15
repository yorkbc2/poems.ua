<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Star;
use App\Poem;

class StarsController extends Controller
{
    public function star( Request $r ) {
    	$user = $r->user;
    	$poem = $r->poem;

    	Star::insert([
    		"user_id" => $user,
    		"poem_id" => $poem
    	]);

        Poem::where("id", $poem)->increment("stars");

    	echo 1;

    }

    public function unstar ( Request $r ) {

    	$user = $r->user;
    	$poem = $r->poem;

    	Star::where([
    		["user_id", "like", $user],
    		["poem_id", "like", $poem]
    	])->delete();

        
        Poem::where("id", $poem)->decrement("stars");

    	echo 1;

    }
}
