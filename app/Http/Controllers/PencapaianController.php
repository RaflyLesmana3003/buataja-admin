<?php

namespace App\Http\Controllers;

use App\pencapaian;
use Illuminate\Http\Request;

class PencapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\pencapaian  $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function show(pencapaian $pencapaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pencapaian  $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function edit(pencapaian $pencapaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pencapaian  $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pencapaian $pencapaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pencapaian  $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(pencapaian $pencapaian)
    {
        //
    }
}
