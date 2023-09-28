<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use DataTables;

class AdminController extends Controller
{
    public function all()
    {
        $admin = Admin::orderBy("id","DESC")->paginate(10);

        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$admin;
        return $response;
    }
    
    public function by_id($id)
    {
        $admin = Admin::find($id);

        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$admin;
        return $response;
    }

    public function search(Request $request)
    {
        $admin = Admin::where("nama_lengkap","LIKE","%".$request->query("q")."%")
        ->orWhere("alamat","LIKE","%".$request->query("q")."%")
        ->orWhere("email","LIKE","%".$request->query("q")."%")
        ->take(10)
        ->get();

        $response["error"]=false;
        $response["msg"]="loaded.";
        $response["result"]=$admin;
        return $response;
    }

    public function datatable()
    {
        return DataTables::of(Admin::orderBy("id","DESC"))->make(true);
    }

    public function datatable_without_self($id)
    {
        return DataTables::of(Admin::where("id","!=",$id)->orderBy("id","DESC"))->make(true);
    }

    public function store(Request $request)
    {
        if(Admin::where("email",$request->input("email"))->first()){
            $response["error"]=true;
            $response["msg"]="email exists.";
            $response["result"]="";
            return $response;
        }else{
            $admin = new Admin;
            $admin->nama_lengkap = $request->input("nama_lengkap");
            $admin->alamat = $request->input("alamat");
            $admin->email = $request->input("email");
            $admin->password = $request->input("password");
            $admin->level = $request->input("level");
            $admin->save();

            $response["error"]=false;
            $response["msg"]="loaded.";
            $response["result"]=$admin;
            return $response;
        }
        
    }
    
    public function login(Request $request)
    {
        $admin = Admin::where("email",$request->input("email"))
        ->where("password",$request->input("password"))
        ->first();

        if($admin){
            $response["error"]=false;
            $response["msg"]="success.";
            $response["result"]=$admin;
            return $response;
        }else{
            $response["error"]=true;
            $response["msg"]="failed.";
            $response["result"]=$admin;
            return $response;
        }        
    }

    public function update($id, Request $request)
    {
        $admin = Admin::find($id);
        $admin->nama_lengkap = $request->input("nama_lengkap");
        $admin->alamat = $request->input("alamat");
        $admin->email = $request->input("email");
        $admin->password = $request->input("password");
        $admin->level = $request->input("level");
        $admin->save();

        $response["error"]=false;
        $response["msg"]="success.";
        $response["result"]=$admin;
        return $response;
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        $response["error"]=false;
        $response["msg"]="deleted.";
        $response["result"]=$admin;
        return $response;
    }
}
