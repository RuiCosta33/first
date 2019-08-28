<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $details = auth()->user();
        return view('meu', ['user' => $details]);

    }

    public function show(Request $request,$id){
        $users = DB::table('users')->paginate(5);
        $details = auth()->user();
        return view('meu_details',['users'=>$users, 'details'=> $details]);

}






    public function details()
    {
        $user=DB::table('users')->paginate(5);
        $details = auth()->user() ;

        return  view('meu_details', ['details'=>$details, 'users'=>$user]);

    }


    public function update(Request $request,$id){
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
        $users = DB::table('users')->paginate(5);
        $details = auth()->user();
        return view('meu_details',['users'=>$users, 'details'=> $details]);
    }


    public function edit()
    {

        $details = auth()->user() ;
        $name = auth()->user()->name ;

        return  view('user_edit', ['user'=>$name, 'details'=> $details]);

    }




}
