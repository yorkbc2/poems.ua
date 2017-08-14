<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public static function hash($password, $cost=11) {
    	$salt = substr(base64_encode(openssl_random_pseudo_bytes(17)), 0 , 22);

		$salt = str_replace("+", ".", $salt);

		$param = "$".implode('$', array(
			"2y",
			str_pad($cost, 2, "0", STR_PAD_LEFT),
			$salt
		));

		return crypt($password, $param);
    }

    public static function valid($password='', $hash)
    {
    	return crypt($password, $hash) == $hash;
    }
}
