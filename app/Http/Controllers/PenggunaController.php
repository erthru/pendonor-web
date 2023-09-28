<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use Illuminate\Support\Facades\File;
use DataTables;

class PenggunaController extends Controller
{
    public function all()
    {
        $pengguna = Pengguna::orderBy("id","DESC")->paginate(10);

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=$pengguna;
        return $response;
    }

    public function by_id($id)
    {
        $pengguna = Pengguna::find($id);

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=$pengguna;
        return $response;
    }

    public function search(Request $request)
    {
        $pengguna = Pengguna::where("nama_lengkap","LIKE","%".$request->query("q")."%")
        ->orWhere("alamat","LIKE","%".$request->query("q")."%")
        ->orWhere("telp","LIKE","%".$request->query("q")."%")
        ->orWhere("email","LIKE","%".$request->query("q")."%")
        ->take(10)
        ->get();

        $response["error"]=false;
        $response["msg"]="loaded";
        $response["result"]=$pengguna;
        return $response;
    }

    public function datatable()
    {
        return DataTables::of(Pengguna::orderBy("id","DESC"))->make(true);
    }

    public function store(Request $request)
    {
        if(Pengguna::where("email",$request->input("email"))->first()){
            $response["error"]=true;
            $response["msg"]="email exists";
            $response["result"]="";
            return $response;
        }else{
            $uploaded_name = uniqid().".jpg";
            File::copy(public_path()."/uploads/foto_default.jpg",public_path()."/uploads/".$uploaded_name);
            
            $pengguna = new Pengguna;
            $pengguna->nama_lengkap = $request->input("nama_lengkap");
            $pengguna->foto = $uploaded_name;
            $pengguna->email = $request->input("email");
            $pengguna->password = $request->input("password");
            $pengguna->save();

            $response["error"]=false;
            $response["msg"]="success";
            $response["result"]=$pengguna;
            return $response;
        }
    }

    public function update_foto($id, Request $request)
    {
        $uploaded_name = uniqid().".jpg";
        $request->file("foto")->move("uploads",$uploaded_name);
        
        $pengguna = Pengguna::find($id);
        $deleted_img = $pengguna->foto;
        $pengguna->foto = $uploaded_name;
        $pengguna->save();

        unlink("uploads/".$deleted_img);

        $response["error"]=false;
        $response["msg"]="success";
        $response["result"]=$pengguna;
        return $response;
    }

    public function update_password($id, Request $request)
    {
        $pengguna = Pengguna::find($id);
        $pengguna->password = $request->input("password");
        $pengguna->save();

        $response["error"]=false;
        $response["msg"]="success";
        $response["result"]=$pengguna;
        return $response;
    }

    public function login(Request $request)
    {
        $pengguna = Pengguna::where("email",$request->input("email"))
        ->where("password",$request->input("password"))
        ->first();

        if($pengguna){
            $response["error"]=false;
            $response["msg"]="success";
            $response["result"]=$pengguna;
            return $response;
        }else{
            $response["error"]=true;
            $response["msg"]="failed";
            $response["result"]=$pengguna;
            return $response;
        }
    }

    public function update($id, Request $request)
    {
        if(Pengguna::where("email",$request->input("email"))->first() && Pengguna::find($id)->email != $request->input("email")){
            $response["error"]=true;
            $response["msg"]="email exists";
            $response["result"]="";
            return $response;
        }else{
            $pengguna = Pengguna::find($id);
            $pengguna->nama_lengkap = $request->input("nama_lengkap");
            $pengguna->email = $request->input("email");
            $pengguna->save();
    
            $response["error"]=false;
            $response["msg"]="success";
            $response["result"]=$pengguna;
            return $response;
        }
    }

    public function delete($id)
    {
        $pengguna = Pengguna::find($id);
        $deleted_img = $pengguna->foto;
        $pengguna->delete();

        unlink("uploads/".$deleted_img);

        $response["error"]=false;
        $response["msg"]="deleted";
        $response["result"]=$pengguna;
        return $response;
    }
}
