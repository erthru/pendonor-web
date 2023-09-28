<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pendonor;
use DataTables;

class PendonorController extends Controller
{
    public function all()
    {
        $pendonor = Pendonor::orderBy("id","DESC")->paginate(10);

        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$pendonor;
        return $response;
    }

    public function by_id($id)
    {
        $pendonor = Pendonor::find($id);
        
        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$pendonor;
        return $response;
    }

    public function by_data(Request $request)
    {
        $pendonor = Pendonor::select("*")->selectSub("6371 * acos(cos(radians(".$request->query("lat")."))*cos(radians(lat))*cos(radians(lng)-radians(".$request->query("lng")."))+sin(radians(".$request->query("lat")."))*sin(radians(lat)))","distance")
        ->orderBy("distance","ASC")
        ->whereRaw("(DATEDIFF(CURDATE(), (SELECT tgl_donor FROM riwayats WHERE pendonor_id = pendonors.id ORDER BY tgl_donor DESC LIMIT 1)) >= 75 OR (SELECT COUNT(*) FROM riwayats WHERE pendonor_id = pendonors.id) = 0)")
        ->where("golongan_darah",$request->query("golongan_darah"))
        ->take(15)
        ->get();

        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$pendonor;
        return $response;
    }

    public function search(Request $request)
    {
        $pendonor = Pendonor::where("nama_lengkap","LIKE","%".$request->query("q")."%")
        ->orWhere("alamat","LIKE","%".$request->query("q")."%")
        ->orWhere("telp","LIKE","%".$request->query("q")."%")
        ->orWhere("jenkel","LIKE","%".$request->query("q")."%")
        ->take(10)
        ->get();

        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$pendonor;
        return $response;
    }

    public function datatable(){
        return DataTables::of(Pendonor::orderBy("id","DESC"))->make(true);
    }

    public function store(Request $request)
    {
        $pendonor = new Pendonor;
        $pendonor->nama_lengkap = $request->input("nama_lengkap");
        $pendonor->alamat = $request->input("alamat");
        $pendonor->telp = $request->input("telp");
        $pendonor->jenkel = $request->input("jenkel");
        $pendonor->golongan_darah = $request->input("golongan_darah");
        $pendonor->resus = $request->input("resus");
        $pendonor->umur = $request->input("umur");
        $pendonor->pekerjaan = $request->input("pekerjaan");
        $pendonor->lat = $request->input("lat");
        $pendonor->lng = $request->input("lng");
        $pendonor->save();

        $response["error"]=false;
        $response["msg"]="success.";
        $response["result"]=$pendonor;
        return $response;
    }
    
    public function check_data(Request $request)
    {
        $pendonor = Pendonor::where("nama_lengkap",$request->input("nama_lengkap"))
        ->where("alamat",$request->input("alamat"))
        ->where("telp",$request->input("telp"))
        ->where("jenkel",$request->input("jenkel"))
        ->where("golongan_darah",$request->input("golongan_darah"))
        ->where("resus",$request->input("resus"))
        ->where("umur", $request->input("umur"))
        ->where("pekerjaan", $request->input("pekerjaan"))
        ->first();

        $response["error"]=false;
        $response["msg"]="success.";
        $response["result"]=$pendonor;
        return $response;
    }

    public function update($id, Request $request)
    {
        $pendonor = Pendonor::find($id);
        $pendonor->nama_lengkap = $request->input("nama_lengkap");
        $pendonor->alamat = $request->input("alamat");
        $pendonor->telp = $request->input("telp");
        $pendonor->jenkel = $request->input("jenkel");
        $pendonor->golongan_darah = $request->input("golongan_darah");
        $pendonor->resus = $request->input("resus");
        $pendonor->umur = $request->input("umur");
        $pendonor->pekerjaan = $request->input("pekerjaan");
        $pendonor->lat = $request->input("lat");
        $pendonor->lng = $request->input("lng");
        $pendonor->save();

        $response["error"]=false;
        $response["msg"]="success.";
        $response["result"]=$pendonor;
        return $response;
    }

    public function delete($id)
    {
        $pendonor = Pendonor::find($id);
        $pendonor->delete();

        $response["error"]=false;
        $response["msg"]="deleted";
        $response["result"]=$pendonor;
        return $response;   
    }

}
