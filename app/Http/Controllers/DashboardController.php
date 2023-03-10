<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Barang;
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

        return view('general/dashboard')->with(['info' => $info, 'barang' => $barang]);
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
