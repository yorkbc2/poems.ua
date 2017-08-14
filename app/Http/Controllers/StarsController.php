<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Star;

class StarsController extends Controller
{
    public function star( Request $r ) {
    	$user = $r->user;
    	$poem = $r->poem;

    	Star::insert([
    		"user_id" => $user,
    		"poem_id" => $poem
    	]);

    	echo 1;

    }

    public function unstar ( Request $r ) {

    	$user = $r->user;
    	$poem = $r->poem;

    	Star::where([
    		["user_id", "like", $user],
    		["poem_id", "like", $poem]
    	])->delete();

    	echo 1;

    }
}
