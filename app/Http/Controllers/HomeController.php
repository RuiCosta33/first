<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {

        $name = auth()->user()->name ;

        return  view('meu', ['user'=>$name]);

}
    public function details()
    {

        $details = auth()->user() ;

        return  view('meu_details', ['details'=>$details]);

    }

}
