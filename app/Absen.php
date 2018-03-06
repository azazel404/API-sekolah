<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
      'absensiswa','mapel_id'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function matapelajarans(){
      return $this->belongsTo('App\Matapelajaran');
    }
}
