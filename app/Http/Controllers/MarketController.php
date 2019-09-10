<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

use Response;
use App\Market;

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
        $prod=Market::all();
        return view('frontoffice.market.market', ['prod'=>$prod]);
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
        $photo = $request->file('img');
        $folder = 'photos';
        $imageName = time().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('/img/'.$folder);
        $photo->move($destinationPath, $imageName);

        $nome = $request->input('name');
        $exists = Market::where('name',$nome)->exists();

        if($exists){
            return redirect()->route('market', ['ver' => 'nada']);
        }

        $prod = new Market;
        $prod->fill($request->all());
        $prod->image=$imageName;
        $prod->save();

        return redirect()->route('market', ['ver' => 'add']);
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
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $prod=Market::where('id',$id)->get();
        return view('pages.market.market_edit', ['prod'=>$prod]);
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
        $photo = Market::where('id',$id)->get('image');
        $image=$request->file('img');
        if($image != null){
            foreach ($photo as $photos){
                $destinationPath = public_path('img/photos/'.$photos->image);

                File::delete($destinationPath);
            }
        }

        $market = Market::findOrFail($id);
        if($request->hasFile('img')) {
            $photo = $request->file('img');
            $folder = 'photos';
            $imageName = time() . '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('/img/' . $folder);
            $photo->move($destinationPath, $imageName);
            $market->image=$imageName;
        }

        $market->fill($request->all());

        $market->updated_at=NOW();
        $market->update();

        $edit='edit';

        return redirect()->route('market', ['ver' => $edit]);
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
        $photo = Market::where('id',$id)->get('image');

        foreach ($photo as $photos){
            $destinationPath = public_path('img/photos/'.$photos->image);

            File::delete($destinationPath);
        }


        Market::where('id', $id)->delete();

        $del='del';
        return redirect()->route('market', ['ver' => $del]);
    }
}
