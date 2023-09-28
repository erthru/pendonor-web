<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformasiUmum extends Model
{
    protected $table = "informasi_umums";
    protected $fillable = ["judul","konten","thumbnail","admin_id"];

    public function admin(){
        return $this->belongsTo("App\Admin","admin_id","id");
    }
}
