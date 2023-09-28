<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchHistory;

class SearchHistoryController extends Controller
{
    public function all()
    {
        $a = SearchHistory::where("golongan_darah","A")->get();
        $b = SearchHistory::where("golongan_darah","B")->get();
        $ab = SearchHistory::where("golongan_darah","AB")->get();
        $o = SearchHistory::where("golongan_darah","O")->get();
        
        $response["status"]=200;
        $response["data"]["A"]=$a->count();
        $response["data"]["B"]=$b->count();
        $response["data"]["AB"]=$ab->count();
        $response["data"]["O"]=$o->count();
        return $response;
    }
    
    public function by_tgl(Request $request)
    {
        $a = SearchHistory::where("golongan_darah","A")->whereRaw("MONTH(created_at) = MONTH('".$request->query('tgl')."') AND YEAR(created_at) = YEAR('".$request->query('tgl')."')")->get();
        $b = SearchHistory::where("golongan_darah","B")->whereRaw("MONTH(created_at) = MONTH('".$request->query('tgl')."') AND YEAR(created_at) = YEAR('".$request->query('tgl')."')")->get();
        $ab = SearchHistory::where("golongan_darah","AB")->whereRaw("MONTH(created_at) = MONTH('".$request->query('tgl')."') AND YEAR(created_at) = YEAR('".$request->query('tgl')."')")->get();
        $o = SearchHistory::where("golongan_darah","O")->whereRaw("MONTH(created_at) = MONTH('".$request->query('tgl')."') AND YEAR(created_at) = YEAR('".$request->query('tgl')."')")->get();
        
        $response["status"]=200;
        $response["data"]["A"]=$a->count();
        $response["data"]["B"]=$b->count();
        $response["data"]["AB"]=$ab->count();
        $response["data"]["O"]=$o->count();
        return $response;
    }
    
    public function store(Request $request)
    {
        $body = [
            "golongan_darah" => $request->input("golongan_darah")
        ];
        
        $response["status"] = 200;
        $response["data"] = SearchHistory::create($body);
        return $response;
    }
}
