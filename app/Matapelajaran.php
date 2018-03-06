<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    //
    protected $fillable = [
        'mapel', 'slug', 'keterangan_mapel',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function absens(){
      return $this->hasMany('App\Absen');
    }
}
