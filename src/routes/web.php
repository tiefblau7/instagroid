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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', 'UserController@index');
Route::get('/datedate', 'datetimes@index');
/**Route::get('/bbs', 'BbsController@index');
Route::post('/bbs', 'BbsController@create');*/
Route::get('github', 'Github\GithubController@top');
Route::post('github/issue', 'Github\GithubController@createIssue');
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('user', 'User\UserController@updateUser');
/**Route::get('/', 'HomeController@index');*/
/**Route::post('/upload', 'HomeController@upload');*/
Route::get('/test', 'TestController@index');
Route::post('/upload', 'PostController@upload');
Route::get('/home', 'PostController@index');
Route::get('/profile/{github_id}', 'ProfileController@index');
Route::get('/post', 'HeaderController@post');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::delete('/deletepost/{id}', 'PostController@destroy')->name('post.delete');
Route::post('/fav/{id}', 'FavController@add')->name('fav.add');
Route::delete('/favdel/{id}', 'FavController@destroy')->name('fav.del');
Route::get('/favlist/{id}', 'FavlistController@index');
