<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Kecamatan;
use App\Tanlong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanlongController extends Controller
{
    public function index(){

        $tanlong = Tanlong::select('desa.nama_desa','tanah_longsor.tahun','tanah_longsor.tanggal','tanah_longsor.korban'
            ,'tanah_longsor.kerusakan', 'tanah_longsor.kerugian', 'tanah_longsor.tanlong_id', 'kecamatan.kecamatan')
            ->join('desa','desa.id','=','desa_id')
            ->join('kecamatan', 'kecamatan.kecamatan_id','=','desa.kecamatan_id')
            ->orderBy('tanlong_id','desc')
            ->get();

        $kecamatan = $this->getKecamatanList();
        $desa = $this->getDataDesa();

        return view('tanlong_table', [
            'tanlong' => $tanlong,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
        ]);
    }

    public function store(Request $request)
    {
        DB::table('tanah_longsor')->insert([
            'desa_id' => $request->desa,
            'tanggal' => $request->tanggal,
            'korban' => $request->korban,
            'kerusakan' => $request->kerusakan,
            'kerugian' => $request->kerugian,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tahun' => date("Y",strtotime($request->tanggal)),
        ]);

        return redirect('/tanlong_table');

    }

    public function edit($id)
    {
        $tanlong = Tanlong::select('tanah_longsor.*','kecamatan.kecamatan_id')
            ->join('desa','desa.id','=','desa_id')
            ->join('kecamatan', 'kecamatan.kecamatan_id','=','desa.kecamatan_id')
            ->where('tanlong_id',$id)->first();
        return response()->json($tanlong);
    }

    public function update(Request $request, $id)
    {
        $tanlong = Tanlong::find($id);
        $tanlong->desa_id = $request->desa;
        $tanlong->tanggal = $request->tanggal;
        $tanlong->korban = $request->korban;
        $tanlong->kerusakan = $request->kerusakan;
        $tanlong->kerugian = $request->kerugian;
        $tanlong->latitude = $request->latitude;
        $tanlong->longitude = $request->longitude;
        $tanlong->save();

        return redirect('/user_table');
    }

    public function hapus($id)
    {
        DB::table('tanah_longsor')->where('tanlong_id',$id)->delete();

        return redirect('/tanlong_table');
    }

    public function getKecamatanList(){
        return $kecamatan = Kecamatan::all();
    }

    public function getDesaList(Request $request){
        $kecamatan_id = $request->kecamatan_id;
        $desa = Desa::where('kecamatan_id', '=', $kecamatan_id)->get();
        return response()->json($desa);
    }

    public function getDataDesa(){
        return $data_desa = Desa::all();
    }

    public function showDesa(Request $request){
        $start_date = intval($request->startDate);
        $end_date = intval($request->endDate);
        $start_id = $request->id;
        $end_id = $start_id;

        if ($request->filter == 1){
            $statement = "kecamatan.kecamatan_id";
        }else if ($request->filter == 2){
            $statement = "desa.id";
        }else{
            $statement = "kecamatan.kecamatan_id";
            $start_id = 0;
            $end_id = 200;
        }

        $tanlong = DB::table('tanah_longsor')
            ->join('desa','desa.id','=','desa_id')
            ->join('kecamatan', 'kecamatan.kecamatan_id','=','desa.kecamatan_id')
            ->whereBetween( $statement, [$start_id, $end_id])
            ->whereBetween('tanah_longsor.tahun',[$start_date,$end_date])
            ->orderBy('tanah_longsor.tahun', 'desc')
            ->get();

        $data_desa = json_encode($tanlong,JSON_PRETTY_PRINT);
        return $data_desa;
    }
}
