<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tanlong;
use DB;

class GraphController extends Controller
{
    public function index(){
        $finalGrafik = $this->getData();

        return view('graph', compact('finalGrafik'));
    }

    public function getData(){

        $dataGrafik = DB::table('tanah_longsor')->select(DB::raw('count(*) as total'), 'tahun')
            ->groupBy('tahun')->orderBy('tahun')->get();
        return response()->json($dataGrafik);
    }
}
