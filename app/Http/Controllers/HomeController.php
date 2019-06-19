<?php

namespace App\Http\Controllers;

use App\Tanlong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     *
     */
    public function index(){
        $final_data = $this->showPoint();
        return view('home', compact ('final_data'));
    }

    public function showPoint(){
        $desa = Tanlong::select('desa.nama_desa', 'desa.longitude', 'desa.latitude', 'tanah_longsor.tahun','tanah_longsor.korban'
            ,'tanah_longsor.kerusakan', 'tanah_longsor.kerugian')
            ->join('desa','desa.id','=','desa_id')
            ->get()->toJson();

        $original_data = json_decode($desa, true);
        $datax = [];

        foreach($original_data as $value) {
            $data = [];
            $maps = [];

            $maps['type'] = "Point";
            $maps['coordinates'] = array( doubleval($value['latitude']) , doubleval($value['longitude']));

            $data['type'] = "Feature";
            $data['geometry'] = $maps;
            $data['properties'] = array('tahun'=>$value['tahun'], 'nama_desa'=>$value['nama_desa'], 'korban'=>$value['korban'], 'kerusakan'=>$value['kerusakan'], 'kerugian'=>$value['kerugian']);
            array_push($datax, $data);
        }


        $new_data = array(
            'type' => 'FeatureCollection',
            'features' => $datax
        );

        $final_data = json_encode($new_data, JSON_PRETTY_PRINT);

        return $final_data;
    }
}
