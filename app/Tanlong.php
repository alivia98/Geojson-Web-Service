<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanlong extends Model
{
    protected $table = 'tanah_longsor';

    protected $primaryKey = 'tanlong_id';

    public $timestamps = false;

    protected $fillable = [
        'desa_id',
        'tanggal',
        'korban',
        'kerusakan',
        'kerugian',
        'latitude',
        'longitude'
    ];

    public function desa()
    {
        return $this->belongsTo('App\Desa');
    }
}
