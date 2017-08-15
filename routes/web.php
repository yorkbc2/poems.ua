<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PoemsController@indexPage");


// Auth controller and auth routes 

Route::get("/auth", "AuthController@index");

Route::post("/auth/up", "AuthController@register");

Route::post("/auth/in", "AuthController@login");

Route::get("/logout", "AuthController@logout");

// --------------------------------------------


// Profile routes with controllers

Route::get("/profile/{id}", "ProfileController@index");

Route::post("/profile/follow", "FollowingController@followNow");

Route::post("/profile/unfollow", "FollowingController@unFollowNow");

Route::get("/following", "FollowingController@myselfFollows");

Route::get("/profile/{id}/following", "FollowingController@getFollowsById");

// ---------------------------------------------

// Admin panel for administrators

Route::get("/admin/panel", "AdminController@panel");

Route::get("/admin/login", "AdminController@login");

Route::post("/admin/login", "AdminController@auth");

Route::get("/admin/logout", "AdminController@logout");

Route::post("/admin/add/category", "PoemsController@addCategory");


// Poems controller and routes

Route::get("/add", "PoemsController@addView");

Route::post("/add", "PoemsController@addPoem");

Route::get("/poem/{id}", "PoemsController@getPoem");

Route::post("/poem/add/review", "PoemsController@addReview");

Route::post("/poem/star", "StarsController@star");

Route::post("/poem/unstar", "StarsController@unstar");


//--------------------------------------------------------------


Route::get("/search", "SearchController@searchByQuery");

Route::get("/feed", "PoemsController@feed");