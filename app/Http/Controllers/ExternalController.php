<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ExternalController extends Controller
{
    public function geocode_reverse(Request $request)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$request->query("lat").",".$request->query("lng")."&key=AIzaSyBsKurseekHERPXhnmngSSzS0USrRHymk4";
        $client = new Client();
        $res = $client->request("GET", $url);
        return $res->getBody();
    }
}
