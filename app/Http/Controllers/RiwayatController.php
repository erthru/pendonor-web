<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Riwayat;
use DataTables;

class RiwayatController extends Controller
{
    public function all()
    {
        $riwayat = Riwayat::with("pendonor")->orderBy("tgl_donor","DESC")->paginate(10);

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=$riwayat;
        return $response;
    }
    
    public function by_tgl(Request $request)
    {
        $riwayat = Riwayat::with("pendonor")->whereRaw("MONTH(tgl_donor) = MONTH('".$request->query('tgl')."') AND YEAR(tgl_donor) = YEAR('".$request->query('tgl')."')")->orderBy("tgl_donor","DESC")->get();

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=$riwayat;
        return $response;
    }

    public function by_pendonor_id($id)
    {
        $riwayat = Riwayat::with("pendonor")->where("pendonor_id",$id)->paginate(10);

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=$riwayat;
        return $response;
    }

    public function datatable()
    {
        return DataTables::of(Riwayat::with("pendonor"))->make(true);
    }

    public function datatable_pendonor($id)
    {
        return DataTables::of(Riwayat::with("pendonor")->orderBy("tgl_donor","DESC")->where("pendonor_id",$id))->make(true);
    }

    public function store(Request $request)
    {
        $riwayat = new Riwayat;
        $riwayat->tgl_donor = $request->input("tgl_donor");
        $riwayat->keterangan = $request->input("keterangan");
        $riwayat->pendonor_id = $request->input("pendonor_id");
        $riwayat->save();

        $response["error"]=false;
        $response["msg"]="success";
        $response["result"]=$riwayat;
        return $response;
    }

    public function delete($id)
    {
        $riwayat = Riwayat::with("pendonor")->find($id);
        $riwayat->delete();

        $response["error"]=false;
        $response["msg"]="deleted";
        $response["result"]=$riwayat;
        return $response;
    }
}
