<?php

namespace App\Http\Controllers;

use App\benefit;
use App\paket;
use App\creator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators) {
            $id_creator = $creators->id;
        }
        $benefit = DB::table('benefits')->where([
            ['ID_CREATOR', '=',$id_creator],
        ])->get();

        // dd($data[0]);
        // return redirect('/');
        return View("kreator/tambahpaket",['benefit' => $benefit,'data' => $creator]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //

        $id_creator;
        $tumbnail = "";
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators) {
            $id_creator = $creators->id;
        }

        $uploaded = $request->photo;
        if ($uploaded === "undefined")
        {
        }
        else
        {
            $file_parts = pathinfo($uploaded);


                $tumbnail = "pk" . time() . Auth::user()->id . $uploaded->getClientOriginalName();

                $ext = pathinfo($tumbnail, PATHINFO_EXTENSION);
                if ($ext == "png" || $ext == "jpg") {
                $uploaded->move(storage_path('/app/public/file') , $tumbnail);
                }else{
                    return response(['data'=>"cover harus berupa .jpg atau .png",'tipe'=>"danger"], 404);
                }

        }

        DB::table('paket')->insert([
            [
                'ID_CREATOR' => $id_creator,
                'nama_paket' => $request->namapaket,
                'desc' =>$request->desc,
                'harga' => $request->harga,
                'limitasi' => 0,
                'jumlah_limitasi' =>0,
                'benefit' => $request->benefit,
                'alamat' =>0,
                'photo' => $tumbnail,
            ]
          ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hapus(Request $request)
    {
        //
        DB::table('paket')->where('id', '=', $request->id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(paket $paket)
    {
        //
    }

    public function editbenefit(Request $request)
    {
        //
        $data = benefit::where('id', $request->id)->get();

        return$data;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(paket $paket)
    {
        //
    }
}
