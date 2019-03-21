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

Route::get('/', "PagesController@home");
Route::get('/services',"PagesController@services");
Route::get('/contact/send',"PagesController@send");
Route::get('/about',"pagesController@about");
Route::get('/contact', "PagesController@contact");
Route::get('/users/{name}/profile', "ProfileController@index");
Route::get('/users/{name}/edit', "ProfileController@edit");
Route::put('/users', "ProfileController@update");
Route::get('/users/{name}/destroy', "ProfileController@destroy");
Route::get('/users/store', "ProfileController@store");
Route::get('/users/create', "ProfileController@create");
Route::resource('posts',"PostsController");
//Route::post('/comments/store', "CommentsController@store");
//Route::delete('/comments/destroy',"CommentsController@destroy");
Route::resource('comments',"CommentsController");
Route::post('/like', "LikesController@like")->name('like');
Route::post('/dislike', "LikesController@dislike")->name('dislike');
Route::get('/admin/dashboard', "AdminController@dashboard");
Route::get('/admin', "AdminController@dashboard");
Route::post('/count', "PostsController@count")->name('count');
Auth::routes();
