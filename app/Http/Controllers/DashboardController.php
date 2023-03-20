<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Info;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        $info = Info::find('1')->first();

        return view('general/login')->with(['info' => $info]);
    }

    public function dashboard()
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        $laba_jan = Penjualan::whereBetween('created_at', [ date('Y').'-01-01 00:00:00', date('Y').'-02-01 00:00:00'])
        ->sum('laba');
        $laba_feb = Penjualan::whereBetween('created_at', [ date('Y').'-02-01 00:00:00', date('Y').'-03-01 00:00:00'])
        ->sum('laba');
        $laba_mar = Penjualan::whereBetween('created_at', [ date('Y').'-03-01 00:00:00', date('Y').'-04-01 00:00:00'])
        ->sum('laba');
        $laba_apr = Penjualan::whereBetween('created_at', [ date('Y').'-04-01 00:00:00', date('Y').'-05-01 00:00:00'])
        ->sum('laba');
        $laba_mei = Penjualan::whereBetween('created_at', [ date('Y').'-05-01 00:00:00', date('Y').'-06-01 00:00:00'])
        ->sum('laba');
        $laba_jun = Penjualan::whereBetween('created_at', [ date('Y').'-06-01 00:00:00', date('Y').'-07-01 00:00:00'])
        ->sum('laba');
        $laba_jul = Penjualan::whereBetween('created_at', [ date('Y').'-07-01 00:00:00', date('Y').'-08-01 00:00:00'])
        ->sum('laba');
        $laba_agus = Penjualan::whereBetween('created_at', [ date('Y').'-08-01 00:00:00', date('Y').'-09-01 00:00:00'])
        ->sum('laba');
        $laba_sep = Penjualan::whereBetween('created_at', [ date('Y').'-09-01 00:00:00', date('Y').'-10-01 00:00:00'])
        ->sum('laba');
        $laba_okt = Penjualan::whereBetween('created_at', [ date('Y').'-10-01 00:00:00', date('Y').'-11-01 00:00:00'])
        ->sum('laba');
        $laba_nov = Penjualan::whereBetween('created_at', [ date('Y').'-11-01 00:00:00', date('Y').'-12-01 00:00:00'])
        ->sum('laba');
        $laba_des = Penjualan::whereBetween('created_at', [ date('Y').'-12-01 00:00:00', date("Y",strtotime("+1 year")).'-01-01 00:00:00'])
        ->sum('laba');

$laba_tahunan= [$laba_jan, $laba_feb, $laba_mar, $laba_apr, $laba_mei, $laba_jun, $laba_jul, $laba_agus, $laba_sep, $laba_okt, $laba_nov, $laba_des];

        return view('general/dashboard')->with(['info' => $info, 'barang' => $barang, 'laba' => $laba_tahunan]);
    }
    public function profile()
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        
        return view('general/profile')->with(['info' => $info, 'barang' => $barang]);
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
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
