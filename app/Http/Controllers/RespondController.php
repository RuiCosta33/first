<?php

namespace App\Http\Controllers;

use App\Post;
use App\Respond;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RespondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(){

    }
    /**
     * Display a listing of the resource.
     *
     * @param int $id_post
     * @param int $ut_post
     * @return Response
     */
    public function bla($id_post, $ut_post)
    {
        $res=Respond::where('id_post', $id_post)->get();
        $resp=Respond::where('id_post', $id_post)->get('id_us_res');
        $post=Post::where('id',$id_post)->get();
        $user=User::where('id',$ut_post)->get();

        foreach($resp as $respo){
            $name = User::where('id', $respo->id_us_res)->get();
        }
        if(isset($name)){
            return view('frontoffice.posts.post_details',['user'=>$user, 'post'=> $post, 'res'=> $res, 'name'=>$name]);
        }
        else  return view('frontoffice.posts.post_details',['user'=>$user, 'post'=> $post, 'res'=> $res]);
    }

    /**
     * Show the form for creating a new resource.
     * @param int $id
     * @param int $post
     * @param int $us_id
     * @param Request $request
     * @return Response
     */
    public function create( Request $request, $id,  $post,  $us_id)
    {
        $message = $request->input('text');
        $id_res=Respond::where('respond', $message)->get('respond');

        if($id_res != $message) {

            Respond::insert(
                    ['id_post' => $post, 'id_us_res' => $us_id, 'respond' => $message, 'created_at'=>NOW()]
                );

            $post=Post::where('id',$post)->paginate(5);
            $user=User::where('id',$id)->get();
            $id_res=Respond::where('respond', $message)->get();
            return view('frontoffice.posts.posts',['user'=>$user, 'posts'=> $post, 'res'=>$id_res, 'bool'=> true]);
        }

        else{
            echo "prank2";exit;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
     */

    public function show($id)
    {
        $post=Post::where('id',$id)->get();
        $res=Respond::where('id_post', $id)->get();
        return view('pages.post.respond', ['post'=>$post, 'res'=>$res]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $res=Respond::where('id',$id)->get();

     return view('pages.post.resp_edit', ['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $res = Respond::findOrFail($id);
        $res->fill($request->all());
        $res->save();
        return redirect()->route('post',['verr'=>'edit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        Respond::where('id', $id)->delete();

            return redirect()->route('post', ['verr'=>'del']);
}
}
