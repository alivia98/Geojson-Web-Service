<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'desa';

    protected $fillable = ['id','nama_desa','longitude','latitude','geom'];

    public function tanlong()
    {
        return $this->hasOne('App\Tanlong');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan');
    }
}
