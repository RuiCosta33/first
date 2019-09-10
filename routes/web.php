<?php

use App\Market;
use App\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use App\User;
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
    return view('auth/login');
});

Route::get('/meu', 'UserController@index')->name('meu');

Route::get('/details', 'HomeController@index')->name('details');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('meu');

Route::get('/meu_details', 'HomeController@details')->name('details');

Route::get('/edit', 'HomeController@edit')->name('edit');

Route::get('/market', 'MarketController@index')->name('market');

Route::get('/edit_ad/{id}', 'UserController@edit')->name('edit_ad');


Route::resource('market', 'MarketController');

Route::resources([
                    'users' => 'UserController',
                    'post'=>'PostController',
                    'admin' => 'HomeController'
    ]);
Route::resource('posts', 'PostController')->only([
    'destroy', 'destroy'
]);


Route::get('/add',  'UserController@create')->name('insert');

Route::get('/del/{id}',  'UserController@destroy')->name('del');



Route::get('/insert', function(){ return view('add');})->name('add');


Route::any('/search',function(){

    $q = Input::get ( 'q' );
    $prod = Market::where('name','LIKE','%'.$q.'%')->orWhere('descricao','LIKE','%'.$q.'%')->get();
    $users = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    $post = Post::where('title','LIKE','%'.$q.'%')->orWhere('message','LIKE','%'.$q.'%')->get();

    if(count($prod)>0 or  count($users) > 0 or count($post)>0){
        return view('pages.search.search', ['post'=>$post, 'prod'=>$prod,'users'=>$users])->withQuery ( $q );
    }
    else{
        $alert='User not found';

        return view ( 'dashboard',  ['ver'=>$alert]);}
});
Route::any('/market_search',function(){

    $q = Input::get ( 'q' );
    $prod = Market::where('name','LIKE','%'.$q.'%')->orWhere('descricao','LIKE','%'.$q.'%')->get();

    if(count($prod) > 0){
        return view('pages.search.market_search')->withDetails($prod)->withQuery ( $q );
    }
    else{
        $prod=Market::paginate(5);
    $alert='User not found';
        return view ( 'pages.market.market',  [ 'details'=>$prod, 'ver'=>$alert]);}
});
Route::any('/user_search',function(){
    $q = Input::get ( 'q' );
    $users = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();

    if(count($users) > 0){
        return view('pages.search.user_search')->withDetails($users)->withQuery ( $q );
    }
    else{
        $users=User::paginate(5);
        $alert='User not found';
        return view ( 'pages.users.index',  [ 'details'=>$users, 'ver'=>$alert]);}
});
Route::any('/post_search',function(){
    $q = Input::get ( 'q' );
    $post = Post::where('title','LIKE','%'.$q.'%')->orWhere('message','LIKE','%'.$q.'%')->get();
    if(count($post) > 0){
        return view('pages.search.post_search')->withDetails($post)->withQuery ( $q );
    }
    else{
        $post=Post::paginate(5);
        $alert='User not found';
        return view ( 'pages.post.typography',  [ 'details'=>$post, 'ver'=>$alert]);}
});


Route::get('/post_details/{id_post}/{ut_post}', 'PostController@details')->name('post_details');

Route::get('/mensagens', 'PostController@basic')->name('messages');

Route::get('/us_post', 'PostController@show')->name('us_post');

Route::get('/post_user', 'PostController@uspost')->name('post_user');

Route::get('/post_user/{id}', 'PostController@form')->name('postform');

Route::get('/create/{id}',  'PostController@create')->name('create');

Route::get('/add_post',  'HomeController@post')->name('add_post');

Route::get('/respond/{id}/{post}/{us_id}',  'PostController@edit')->name('respond');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('market', 'MarketController');
    Route::resource('post', 'PostController');
    Route::resource('respond', 'RespondController');

	Route::get('market', function () {
        $prod = App\Market:: all();
        if(auth()->user()->level == 4){
            return view('pages.market.market',['prod' => $prod]);
        }
		else return view('frontoffice.market.market', ['prod'=>$prod]);
	})->name('market');

    Route::get('market_edit/{id}', function ($id) {
        $prod=App\Market:: find($id);
        return view('pages.market.market_edit', ['prod' => $prod]);
    })->name('market_edit');


    Route::get('add_prod', function () {
        return view('pages.market.prod_add');
    })->name('add_prod');

    Route::get('add_posts', function () {
        return view('pages.post.add_post');
    })->name('add_posts');

    Route::get('post_edit/{id}', function ($id) {
        $post=App\Post::where('id',$id)
                    ->get();

        return view('pages.post.post_edit', ['post' => $post]);
    })->name('post_edit');

	Route::get('post', function () {
        $post = App\Post:: all();
		return view('pages.post.typography',['post'=>$post]);
	})->name('post');

    Route::get('date', function () {
        return view('pages.date');
    })->name('date');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

