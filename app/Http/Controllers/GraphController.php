<?php

namespace App\Http\Controllers;

use App\Desa;
use Illuminate\Http\Request;
use App\Tanlong;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function index(){
        $finalGrafik = $this->getData();
//        $finalPemetaan = $this->getPemetaan();
        $data_desa = $this->getDesa();

        return view('graph', [
            'data_desa' => $data_desa,
            'finalGrafik' => $finalGrafik,
        ]);
    }

    public function getData(){

        $dataGrafik = DB::table('tanah_longsor')->select(DB::raw('count(*) as total'), 'tahun')
            ->groupBy('tahun')->orderBy('tahun')->get();
        return response()->json($dataGrafik);
    }

    public function getPemetaan($id){

        $dataPemetaan = DB::table('tanah_longsor')->select(DB::raw('count(*) as total'), 'desa.nama_desa')
            ->join('desa','desa.id','=','desa_id')
            ->groupBy('desa.nama_desa')->orderBy('desa.nama_desa')->get();

        $data = Tanlong::all()->where('desa_id', $id)->groupBy('desa_id')->first();
        if($data){
            return count($data);
        }else{
            return 0;
        }
    }

    public function getDesa(){
        $desa = Desa::select(DB::raw("ST_AsGeoJSON(ST_Transform(ST_SetSRID(desa.geom,4326),4326))::json As geometry"),'desa.nama_desa','desa.id')
                ->get();

        $original_data=json_decode($desa,true);
        foreach ($original_data as $key =>$value){
            $features[]=array(
                'type' => 'Feature',
                'geometry'=>json_decode($value["geometry"], true),
                'properties'=>array('nama_desa'=>$value['nama_desa'], 'jumlah' => $this->getPemetaan($value['id']))
            );
        };
        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);

        $data_desa = json_encode($allfeatures,JSON_PRETTY_PRINT);
        return $data_desa;
    }
}
