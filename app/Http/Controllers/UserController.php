<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('meu');


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function details(){
        return view('meu_details');
    }


    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirm = $request->input('password_confirmation');
        if($password === $password_confirm){
            $pass = Hash::make($password);
        }
        DB::table('users')
            ->insert(
                ['email' => $email, 'name' => $name, 'password'=> $pass]
            );
        $user=DB::table('users')->paginate(1);
        $details = auth()->user() ;
        return view('meu_details',['users'=>$user, 'details'=> $details]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first() ;
        $details = auth()->user() ;
        return  view('user_edit', ['user'=>$user, 'details'=> $details]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirm = $request->input('password_confirmation');
        if($password === $password_confirm){
            $pass = Hash::make($password);
        }
        DB::table('users')
            ->where('id', $id)
            ->update(
                ['email' => $email, 'name' => $name, 'password'=> $pass]
            );

        $user=DB::table('users')->paginate(5);
        $details = auth()->user() ;
        return view('meu_details',['users'=>$user, 'details'=> $details]);
    }



    public function us(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        $user=DB::table('users')->paginate(5);
        $details = auth()->user() ;
        return view('meu_details',['users'=>$user, 'details'=> $details]);
    }




}
