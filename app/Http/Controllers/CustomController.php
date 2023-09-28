<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomController extends Controller
{
    public function stok_darah(){

        $total_pendonor = DB::table("pendonors")
        ->select(DB::raw("COUNT(*) as total"))
        ->first();

        $bisa_donor = DB::select("SELECT COUNT(*) AS total FROM pendonors WHERE DATEDIFF(CURDATE(), (SELECT tgl_donor FROM riwayats WHERE pendonor_id = pendonors.id ORDER BY tgl_donor DESC LIMIT 1)) >= 75 OR (SELECT COUNT(*) FROM riwayats WHERE pendonor_id = pendonors.id) = 0")[0];

        $bisa_donor_a = DB::select("SELECT COUNT(*) AS total FROM pendonors WHERE (DATEDIFF(CURDATE(), (SELECT tgl_donor FROM riwayats WHERE pendonor_id = pendonors.id ORDER BY tgl_donor DESC LIMIT 1)) >= 75 OR (SELECT COUNT(*) FROM riwayats WHERE pendonor_id = pendonors.id) = 0) AND golongan_darah = 'A'")[0];

        $bisa_donor_b = DB::select("SELECT COUNT(*) AS total FROM pendonors WHERE (DATEDIFF(CURDATE(), (SELECT tgl_donor FROM riwayats WHERE pendonor_id = pendonors.id ORDER BY tgl_donor DESC LIMIT 1)) >= 75 OR (SELECT COUNT(*) FROM riwayats WHERE pendonor_id = pendonors.id) = 0) AND golongan_darah = 'B'")[0];

        $bisa_donor_ab = DB::select("SELECT COUNT(*) AS total FROM pendonors WHERE (DATEDIFF(CURDATE(), (SELECT tgl_donor FROM riwayats WHERE pendonor_id = pendonors.id ORDER BY tgl_donor DESC LIMIT 1)) >= 75 OR (SELECT COUNT(*) FROM riwayats WHERE pendonor_id = pendonors.id) = 0) AND golongan_darah = 'AB'")[0];

        $bisa_donor_o = DB::select("SELECT COUNT(*) AS total FROM pendonors WHERE (DATEDIFF(CURDATE(), (SELECT tgl_donor FROM riwayats WHERE pendonor_id = pendonors.id ORDER BY tgl_donor DESC LIMIT 1)) >= 75 OR (SELECT COUNT(*) FROM riwayats WHERE pendonor_id = pendonors.id) = 0) AND golongan_darah = 'O'")[0];
        
        $tahun = DB::select("SELECT SUBSTRING(tgl_donor, 1,4) AS tahun FROM riwayats GROUP BY tahun ORDER BY tahun DESC");

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["data"]["pendonor"]=$total_pendonor;
        $response["data"]["bisa_donor"]=$bisa_donor;
        $response["data"]["bisa_donor_a"]=$bisa_donor_a;
        $response["data"]["bisa_donor_b"]=$bisa_donor_b;
        $response["data"]["bisa_donor_ab"]=$bisa_donor_ab;
        $response["data"]["bisa_donor_o"]=$bisa_donor_o;
        $response["data"]["tahun"]=$tahun;
        return $response;

    }

}
