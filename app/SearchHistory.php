<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $table = "search_historys";
    protected $fillable = ["golongan_darah"];
}
