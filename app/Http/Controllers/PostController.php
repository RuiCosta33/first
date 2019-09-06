<?php

namespace App\Http\Controllers;

use App\Post;
use App\Respond;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request){

        $post = new Post;
$id=Auth::user()->id;
        $post->title = $request->title;
        $post->message = $request->text;
        $post->idut = $id;
        $post->save();
        return redirect()->route('post');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $post=Post::paginate(5);
        return view('frontoffice.posts.posts', ['posts' => $post]);
    }
    public function basic()
    {
        $id = auth()->user()->id;
        return view('frontoffice.posts.post', ['id' => $id]);
    }

    public function form($id)
    {
        $post = Post::where('id', $id)->get();
        return view('frontoffice.posts.post_edit', ['post' => $post]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
{
    $title = $request->input('title');
    $message = $request->input('text');

    Post:: where('id', $id)
        ->update(
            ['title' => $title, 'message' => $message]
        );

    $user=User::paginate(5);
    $details = auth()->user() ;
    return redirect('post');

}
    public function details($id_post, $ut_post)
{

    $res=Respond::where('id_post', $id_post)->get();
    $resp=Respond::where('id_post', $id_post)->get('id_us_res');
    $post=Post::where('id',$id_post)->get();
    $user=User::where('id',$ut_post)->get();

    foreach($resp as $respo){
        $name =User::where('id', $respo->id_us_res)->get();
        return view('frontoffice.posts.post_details',['user'=>$user, 'post'=> $post, 'res'=> $res, 'name'=>$name]);
    }


    return view('frontoffice.posts.post_details',['user'=>$user, 'post'=> $post, 'res'=> $res]);
}

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        Respond::where('id_post', $id)->delete();

        return redirect('home');
    }

    public function uspost()
    {
        $id= auth()->user()->id;
        $post=Post::where('idut',$id)->get();

        return view('frontoffice.posts.post_profile',['post'=> $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

}
