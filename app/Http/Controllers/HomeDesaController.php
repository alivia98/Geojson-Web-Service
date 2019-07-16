<?php

namespace App\Http\Controllers;

use App\Tanlong;
use App\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeDesaController extends Controller
{
    public function showDesa(){
        $desa = Tanlong::select(DB::raw("ST_AsGeoJSON(ST_Transform(ST_SetSRID(desa.geom,4326),4326))::json As geometry"),'desa.nama_desa','tanah_longsor.tahun','tanah_longsor.korban'
            ,'tanah_longsor.kerusakan', 'tanah_longsor.kerugian')
            ->join('desa','desa.id','=','desa_id')
            ->get();

        $original_data=json_decode($desa,true);
        foreach ($original_data as $key =>$value){
            $features[]=array(
                'type' => 'Feature',
                'geometry'=>json_decode($value["geometry"], true),
                'properties'=>array('tahun'=>$value['tahun'], 'nama_desa'=>$value['nama_desa'], 'korban'=>$value['korban'], 'kerusakan'=>$value['kerusakan'], 'kerugian'=>$value['kerugian'])
            );
        };
        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);

        $data_desa = json_encode($allfeatures,JSON_PRETTY_PRINT);
        return $data_desa;
    }
    public function index(){
        $data_desa = $this->showDesa();
        return view('homedesa', compact ('data_desa'));
    }
}
