<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

use Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod=DB::table('market')->get();
        return view('market', ['prod'=>$prod]);
    }
    /**
     * Save an Image
     *
     * @param \Illuminate\Http\UploadedFile $photo
     * @param string $folder
     * @return string
     */
    public function saveImage($photo, $folder = 'photos'){
        $imageName = time().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('/images/'.$folder);
        $photo->move($destinationPath, $imageName);
        return $photoPath = '/images/'.$folder.'/'.$imageName;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = $request->file('image');
        $folder = 'photos';
        $imageName = time().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('/img/'.$folder);
        $photo->move($destinationPath, $imageName);

        $nome = $request->input('nome');
        $desc = $request->input('descricao');
        $preco = $request->input('preco');
        $ver=DB::table('market')->get('name');

        foreach ($ver as $names){

            if($names->name ==  $nome ) {
                $erro='nada';
                $prod=DB::table('market')->get();
                return redirect()->route('table' );
            }
            else{
                DB::table('market')
                    ->insert(
                        ['name' => $nome, 'descricao' => $desc, 'preco'=> $preco, 'image'=>$imageName,'created_at'=>NOW()]
                    );
                $add='add';
                $prod=DB::table('market')->get();
                return redirect()->route('table');
            }

        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param \Illuminate\Http\UploadedFile $photo
     * @param string $folder
     * @return string
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $nome = $request->input('nome');
        $desc = $request->input('descricao');
        $preco = $request->input('preco');

        DB::table('market')
            ->where('id', $id)
            ->update(
                ['name' => $nome, 'descricao' => $desc, 'preco'=> $preco, 'updated_at'=>NOW()]
            );
        $edit='edit';
        $prod=DB::table('market')->get();
        return redirect()->route('table');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param \Illuminate\Http\UploadedFile $photo
     * @param string $folder

     * @return string
     */
    public function destroy($id)
    {
        $photo = DB::table('market')->where('id',$id)->get('image');
        foreach ($photo as $photos){
            $destinationPath = public_path('img/photos/'.$photos->image);
            File::delete($destinationPath);
        }

        DB::table('market')->where('id', $id)->delete();

        $prod=DB::table('market')->get();
        return view('pages.table_list',['prod'=>$prod]);
    }
}
