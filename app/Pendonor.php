<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendonor extends Model
{
    protected $table = "pendonors";
    protected $fillable = ["nama_lengkap","alamat","telp","jenkel","golongan_darah","resus","umum","pekerjaan","lat","lng"];
}
