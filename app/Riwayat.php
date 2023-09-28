<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = "riwayats";
    protected $fillable = ["tgl_donor","keterangan","pendonor_id"];

    public function pendonor()
    {
        return $this->belongsTo("App\Pendonor","pendonor_id","id");
    }
}
