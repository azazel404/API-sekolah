<?php

namespace App\Http\Controllers;
use App\Matapelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{

  //untuk menampilkan seluruh data
  public function index(){

    return Matapelajaran::all();

  }
  //untuk menampilkan beberapa data
  public function show($slug){
    $mapel = Matapelajaran::where('slug',$slug)->first();
    if (!$mapel) {
      return response()->json(['error' => 'id mapel tidak ditemukan'],404);
    }
    else{
      return response()->json($mapel);
    }
  }


  //untuk fungsi create
  public function store(Request $request){

    $this->validate($request,[
        'mapel' => 'required|max:255',
        'keterangan_mapel' => 'required|max:255'
    ]);

    $mapel =  $request->user()->matapelajarans()->create([
        'mapel' => $request->json('mapel'),
        'slug' => str_slug($request->json('mapel')),
        'keterangan_mapel' => $request->json('keterangan_mapel')
    ]);

    return $mapel;

  }

  public function update(Request $request, $id){

    $mapelupdate = Matapelajaran::find($id);
    if ($request->user()->id != $mapelupdate->user_id) {
      return response()->json(['error' => 'id mapel tidak ditemukan'],404);
    }
    $mapelupdate->mapel = $request->mapel;
    $mapelupdate->keterangan_mapel = $request->keterangan_mapel;
    $mapelupdate->save();
    return $mapelupdate;
  }

  public function destroy(Request $request, $id){

    $mapeldelete = Matapelajaran::find($id);

      if ($request->user()->id != $mapeldelete->user_id) {
        return response()->json(['error' => 'id gagal dihapus dan tidak ditemukan'],404);
      }
      $mapeldelete->delete();
      return response()->json(["success" => "sukses terhapus"],200);
  }

}
