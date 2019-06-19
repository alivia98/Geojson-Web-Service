<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanlong extends Model
{
    protected $table = 'tanah_longsor';

    public function desa()
    {
        return $this->belongsTo('App\Desa');
    }
}
