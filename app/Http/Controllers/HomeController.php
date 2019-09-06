<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()-> level == "4"){
           return view('dashboard');
        }
        elseif(auth()->user()->level == "1"){
            $user=auth()->user();
            return view('frontoffice.users.meu', ['user' => $user]);

        }

    }
    public function details()
    {
        $user=User::all();
        $details = auth()->user() ;
        return  view('frontoffice.users.meu_details', ['details'=>$details, 'users'=>$user]);
    }
    public function update(Request $request,$id)
    {
        $name= $request->name;
        $email= $request->email;
        try{
            $user = User::findOrFail($id);
            if(null !== $user){
                $user->fill(['name' => $name ]);
                $user->fill(['email' => $email]);
                $user->save();
            }
            else{
                echo "erro";exit;
            }
        }
        catch (\Exception $e){
            dd($e);
        }
        $users = User::all();
        $details = auth()->user();
        return view('frontoffice.users.meu_details',['users'=>$users, 'details'=> $details]);
    }
    public function edit()
    {
        $details = auth()->user() ;
        $name = auth()->user()->name ;
        return  view('frontoffice.users.user_edit', ['user'=>$name, 'details'=> $details]);
    }
}
