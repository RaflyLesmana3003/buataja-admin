<?php

namespace App\Http\Controllers;

use App\benefit;
use App\creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BenefitController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = now();
        //
        $Data = $request->Data;
        // dd($Data);
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators) {
            $id_creator = $creators->id;
        } 
            DB::table('benefits')->insert([
              [
                 'ID_CREATOR' => $id_creator,
                  'nama_paket' => $Data['namabenefit'],
                  'tipe' => $Data['tipe'],
                  'created_at' => $date
              ]
            ]);
    }

    public function edit(Request $request)
    {
        $date = now();
        //
        $Data = $request->Data;
        // dd($Data);
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators) {
            $id_creator = $creators->id;
        } 

            DB::table('benefits')->where('id', '=',$Data['id'])->update([
             
                  'nama_paket' => $Data['namabenefit'],
                  'tipe' => $Data['tipe']
              
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\benefit  $benefit
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, benefit $benefit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(benefit $benefit)
    {
        //
    }
}
