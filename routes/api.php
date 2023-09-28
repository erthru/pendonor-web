<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// admin
Route::get("admin","AdminController@all");
Route::get("admin/{id}","AdminController@by_id");
Route::get("admin/search/data","AdminController@search");
Route::get("admin/datatable/show","AdminController@datatable");
Route::get("admin/datatable_without_self/show/{id}","AdminController@datatable_without_self");
Route::post("admin","AdminController@store");
Route::post("admin/login","AdminController@login");
Route::put("admin/{id}","AdminController@update");
Route::delete("admin/{id}","AdminController@delete");

// pendonor
Route::get("pendonor", "PendonorController@all");
Route::get("pendonor/{id}", "PendonorController@by_id");
Route::get("pendonor/by/data", "PendonorController@by_data");
Route::get("pendonor/search/data", "PendonorController@search");
Route::get("pendonor/datatable/show", "PendonorController@datatable");
Route::post("pendonor", "PendonorController@store");
Route::post("pendonor/checkdata", "PendonorController@check_data");
Route::put("pendonor/{id}", "PendonorController@update");
Route::delete("pendonor/{id}", "PendonorController@delete");

// pengguna
Route::get("pengguna", "PenggunaController@all");
Route::get("pengguna/{id}", "PenggunaController@by_id");
Route::get("pengguna/search/data", "PenggunaController@search");
Route::get("pengguna/datatable/show", "PenggunaController@datatable");
Route::post("pengguna", "PenggunaController@store");
Route::post("pengguna/foto/{id}", "PenggunaController@update_foto");
Route::post("pengguna/login", "PenggunaController@login");
Route::put("pengguna/{id}", "PenggunaController@update");
Route::put("pengguna/password/{id}", "PenggunaController@update_password");
Route::delete("pengguna/{od}", "PenggunaController@delete");

// riwayat
Route::get("riwayat", "RiwayatController@all");
Route::get("riwayat/pendonor/{id}", "RiwayatController@by_pendonor_id");
Route::get("riwayat/datatable/show", "RiwayatController@datatable");
Route::get("riwayat/pendonor/datatable/show/{id}", "RiwayatController@datatable_pendonor");
Route::get("riwayat/by/tgl", "RiwayatController@by_tgl");
Route::post("riwayat", "RiwayatController@store");
Route::delete("riwayat/{id}", "RiwayatController@delete");

// informasi umum
Route::get("informasi_umum","InformasiUmumController@all");
Route::get("informasi_umum/{id}","InformasiUmumController@by_id");
Route::get("informasi_umum/cari/query","InformasiUmumController@search");
Route::get("informasi_umum/datatable/show","InformasiUmumController@datatable");
Route::post("informasi_umum","InformasiUmumController@store");
Route::post("informasi_umum/thumbnail/{id}","InformasiUmumController@update_thumbnail");
Route::put("informasi_umum/{id}","InformasiUmumController@update");
Route::delete("informasi_umum/{id}","InformasiUmumController@delete");

// search history
Route::get("search_history","SearchHistoryController@all");
Route::get("search_history/by_tgl","SearchHistoryController@by_tgl");
Route::post("search_history","SearchHistoryController@store");

//external
Route::get("external/geocoding/reverse","ExternalController@geocode_reverse");

//custom
Route::get("custom/stok/darah", "CustomController@stok_darah");