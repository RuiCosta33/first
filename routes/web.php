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

Route::resources(['users' => 'UserController',
                  'admin' => 'HomeController'
    ]);


Route::get('/del/{id}',  'UserController@destroy')->name('del');


Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('search')->withDetails($user)->withQuery ( $q );

    else{
        $user=DB::table('users')->get();
    $details = auth()->user() ;
    $alert='User not found';
        return view ( 'meu_details',  ['details'=>$details, 'users'=>$user, 'ver'=>$alert]);}
});
