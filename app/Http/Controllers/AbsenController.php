<?php

namespace App\Http\Controllers;
use App\Absen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{


  public function store(Request $request, $id){

    $this->validate($request,[
        'absensiswa' => 'required',
    ]);

    $absen = $request->user()-absens()->create([
        'absensiswa' => $request->json('absensiswa'),
        'mapel_id' => $id
    ]);
    return $absen;

  }



}
