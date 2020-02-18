<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/creator/{id}', 'followerController@search');

Route::get('/', function () {
$with = DB::table('withdrawals')->join('creators', 'withdrawals.ID_CREATOR', '=', 'creators.id')->join('bank', 'withdrawals.bank', '=', 'bank.code')->select(
    "creators.name as kreator",
    "withdrawals.id",
    "withdrawals.total",
    "withdrawals.created_at",
    "withdrawals.rekening_tujuan",
    "withdrawals.atas_nama","bank.name","withdrawals.status")->orderBy('withdrawals.created_at', 'desc')->get();
// dd($with);
return View("pencairan/pencairan",['with'=>$with]);
  
});

Route::post('/successpenarikan', 'CreatorController@success');
Route::post('/gagalpenarikan', 'CreatorController@gagal');
Auth::routes(['verify' => true]);

