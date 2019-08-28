<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\IsTrue;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id){

        $title = $request->input('title');
        $message = $request->input('text');
        DB::table('post')
            ->insert(
                ['title' => $title, 'message' => $message, 'idut'=> $id,'created_at'=>NOW()]
            );
        $details = auth()->user() ;
        return redirect()->route('details', ['details'=> $details]);
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
    public function show()
    {
        $post=DB::table('post')->paginate(5);
        return view('posts', ['posts' => $post]);
    }
    public function basic()
    {
        $id = auth()->user()->id;
        return view('post', ['id' => $id]);
    }

    public function form($id)
    {
        $post = DB::table('post')->where('id', $id)->get();
        return view('post_edit', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @param $post
     * @param $us_id
     * @return void
     */
    public function edit(Request $request, $id, $post, $us_id)
    {
        $message = $request->input('text');
        $id_res=DB::table('responds')->where('respond', $message)->get('respond');

        if($id_res != $message) {
            DB::table('responds')
                ->insert(
                    ['id_post' => $post, 'id_us_res' => $us_id, 'respond' => $message, 'created_at'=>NOW()]
                );
            $post=DB::table('post')->where('id',$post)->paginate(5);
            $user=DB::table('users')->where('id',$id)->get();
            $id_res=DB::table('responds')->where('respond', $message)->get();
            return view('posts',['user'=>$user, 'posts'=> $post, 'res'=>$id_res, 'bool'=> true]);
        }
        else{
            echo "prank2";exit;
        $post=DB::table('post')->where('id',$post)->get();
        $user=DB::table('users')->where('id',$id)->get();
        $id_res=DB::table('responds')->where('respond', $message)->get();
            foreach($res as $resp){
                $name=DB::table('users')->where('id',$resp->id_us_res)->get();
            }
        return view('post_details',['user'=>$user, 'post'=> $post, 'res'=>$id_res, 'name'=>$name]);}
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
    $title = $request->input('title');
    $message = $request->input('text');

    DB::table('post')
        ->where('id', $id)
        ->update(
            ['title' => $title, 'message' => $message]
        );

    $user=DB::table('users')->paginate(5);
    $details = auth()->user() ;
    return view('meu_details',['users'=>$user, 'details'=> $details]);

}
    public function details($id_post, $ut_post)
{

    $res=DB::table('responds')->where('id_post', $id_post)->get();
    $resp=DB::table('responds')->where('id_post', $id_post)->get('id_us_res');
    $post=DB::table('post')->where('id',$id_post)->get();
    $user=DB::table('users')->where('id',$ut_post)->get();

    foreach($resp as $respo){
        $name = DB::table('users')->where('id', $respo->id_us_res)->get();
    }

    return view('post_details',['user'=>$user, 'post'=> $post, 'res'=> $res, 'name'=>$name]);
    return view('post_details',['user'=>$user, 'post'=> $post, 'res'=> $res]);
}

    public function destroy($id)
    {
        DB::table('responds')->where('id_post', $id)->delete();
        DB::table('post')->where('id', $id)->delete();

        return redirect('home');
    }

    public function uspost()
    {
        $id= auth()->user()->id;
        $post=DB::table('post')->where('idut',$id)->get();

        return view('post_profile',['post'=> $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
