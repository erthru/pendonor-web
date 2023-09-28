<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InformasiUmum;
use Illuminate\Support\Facades\File;
use DataTables;

class InformasiUmumController extends Controller
{
    public function all()
    {
        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=InformasiUmum::with("admin")->select("*")->selectSub("strip_tags(konten)","rendered_konten")->orderBy("id","DESC")->paginate(10);
        return $response;
    }

    public function by_id($id)
    {
        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=InformasiUmum::with("admin")->select("*")->selectSub("strip_tags(konten)","rendered_konten")->find($id);
        return $response;
    }

    public function search(Request $request)
    {
        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=InformasiUmum::with("admin")->select("*")->selectSub("strip_tags(konten)","rendered_konten")->where("judul","LIKE","%".$request->query('q')."%")->orWhere("konten","LIKE","%".$request->query('q')."%")->orderBy("id","DESC")->take(10)->get();
        return $response;
    }

    public function datatable()
    {
        return DataTables::of(InformasiUmum::with("admin")->select("*")->selectSub("strip_tags(konten)","rendered_konten")->orderBy("id","DESC"))->make(true);
    }

    public function store(Request $request)
    {
        $uploaded_name = uniqid().".jpg";

        if($request->file("thumbnail") == null){
            File::copy(public_path()."/uploads/img_default.jpg",public_path()."/uploads/".$uploaded_name);
        }else{
            $request->file("thumbnail")->move("uploads",$uploaded_name);
        }

        $informasi_umum = new InformasiUmum;
        $informasi_umum->judul = $request->input("judul");
        $informasi_umum->konten = $request->input("konten");
        $informasi_umum->thumbnail = $uploaded_name;
        $informasi_umum->admin_id = $request->input("admin_id");
        $informasi_umum->save();

        $response["error"]=false;
        $response["msg"]="success";
        $response["result"]=$informasi_umum;
        return $response;
    }

    public function update_thumbnail($id, Request $request)
    {
        $uploaded_name = uniqid().".jpg";
        $request->file("thumbnail")->move("uploads",$uploaded_name);

        $informasi_umum = InformasiUmum::find($id);
        $deleted_thumbnail = $informasi_umum->thumbnail;
        $informasi_umum->thumbnail = $uploaded_name;
        $informasi_umum->save();

        unlink("uploads/".$deleted_thumbnail);

        $response["error"]=false;
        $response["msg"]="success";
        $response["result"]=$informasi_umum;
        return $response;
    }

    public function update($id, Request $request)
    {
        $informasi_umum = InformasiUmum::find($id);
        $informasi_umum->judul = $request->input("judul");
        $informasi_umum->konten = $request->input("konten");
        $informasi_umum->admin_id = $request->input("admin_id");
        $informasi_umum->save();

        $response["error"]=false;
        $response["msg"]="success";
        $response["result"]=$informasi_umum;
        return $response;
    }

    public function delete($id)
    {
        $informasi_umum = InformasiUmum::find($id);
        $deleted_thumbnail = $informasi_umum->thumbnail;
        $informasi_umum->delete();

        unlink("uploads/".$deleted_thumbnail);

        $response["error"]=false;
        $response["msg"]="deleted";
        $response["result"]=$informasi_umum;
        return $response;
    }
}
