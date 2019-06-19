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
        return view('tanlong_table', [
            'tanlong' => $tanlong,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function store(Request $request)
    {
        // insert data ke table pegawai
        DB::table('tanah_longsor')->insert([
            'desa_id' => $request->desa,
            'tanggal' => $request->tanggal,
            'korban' => $request->korban,
            'kerusakan' => $request->kerusakan,
            'kerugian' => $request->kerugian,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/tanlong_table');

    }

    public function edit($id)
    {
        // mengambil data tanlong berdasarkan id yang dipilih
        $tanlong = DB::table('tanah_longsor')->where('tanlong_id',$id)->first();
        $tanlong = Tanlong::select('tanah_longsor.*','kecamatan.kecamatan_id')
            ->join('desa','desa.id','=','desa_id')
            ->join('kecamatan', 'kecamatan.kecamatan_id','=','desa.kecamatan_id')
            ->where('tanlong_id',$id)->first();
        // passing data tanlong yang didapat ke view edit.blade.php
        return response()->json($tanlong);
    }



    public function update(Request $request, $id)
    {
        DB::table('tanah_longsor')->where('tanlong_id',$id)->update([
            'desa_id' => $request->desa,
            'tanggal' => $request->tanggal,
            'korban' => $request->korban,
            'kerusakan' => $request->kerusakan,
            'kerugian' => $request->kerugian,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        // alihkan halaman ke halaman tanlong
        return redirect('/tanlong_table');
    }

    // method untuk hapus data tanlong
    public function hapus($id)
    {
        // menghapus data tanlong berdasarkan id yang dipilih
        DB::table('tanah_longsor')->where('tanlong_id',$id)->delete();

        // alihkan halaman ke halaman tanlong
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

}
