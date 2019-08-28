<?php
use Illuminate\Support\Facades\Input;
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

Route::get('/edit_ad/{id}', 'UserController@edit')->name('edit_ad');

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
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('search')->withDetails($user)->withQuery ( $q );

    else{
        $user=DB::table('users')->paginate(5);
    $details = auth()->user() ;
    $alert='User not found';
        return view ( 'meu_details',  ['details'=>$details, 'users'=>$user, 'ver'=>$alert]);}
});


Route::get('/post_details/{id_post}/{ut_post}', 'PostController@details')->name('post_details');

Route::get('/mensagens', 'PostController@basic')->name('messages');

Route::get('/us_post', 'PostController@show')->name('us_post');

Route::get('/post_user', 'PostController@uspost')->name('post_user');

Route::get('/post_user/{id}', 'PostController@form')->name('postform');

Route::get('/create/{id}',  'PostController@create')->name('create');

Route::get('/add_post',  'HomeController@post')->name('add_post');

Route::get('/respond/{id}/{post}/{us_id}',  'PostController@edit')->name('respond');

Route::resource('market', 'MarketController');


