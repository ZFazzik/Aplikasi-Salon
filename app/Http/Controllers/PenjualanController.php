<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\User;
use App\Models\Info;
use Illuminate\Http\Request;
use DataTables;
use File;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Penjualan::latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama',function ($row){
            $dataBarang = Barang::find($row->id_barang);
            // $dataBarang->nama;

            return $dataBarang->nama;
        })
        ->addColumn('action',function ($row){
            $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-success btn-sm detailPenjualan">Detail</a>';

            return $btn;
        })
        ->rawColumns(['nama','action'])
        ->make(true);
    }

    public function salonPenjualan(Request $request)
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        
        return view('penjualan.penjualan')->with(['info' => $info, 'barang' => $barang]);
    }
    public function detailPenjualan($id)
    {
        $penjualan = Penjualan::find($id);
        $pegawai = User::find($penjualan->id_pegawai);
        $barang = Barang::find($penjualan->id_barang);

        return response()->json(array(
            'dataPenjualan' => $penjualan,
            'dataBarang' => $barang,
            'dataPegawai' => $pegawai,
        ));
    }
    public function cetakPenjualan($dari, $sampai, $opsi)
    {
        if($opsi == 'pick'){
            $waktu_dari = ' 00:00:00';
            $waktu_sampai = ' 23:59:59';
            
        }else if($opsi == 'bulanan'){
            $waktu_dari = ' 00:00:00';
            $waktu_sampai = ' 00:00:00';
        }
        
        $penjualan = Penjualan::join('tbl_barang','tbl_barang.id','=','tbl_penjualan.id_barang')
        ->join('users','users.id','=','tbl_penjualan.id_pegawai')
        ->whereBetween('tbl_penjualan.created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->get(['tbl_barang.nama as nama_barang',
        'tbl_penjualan.jumlah as jumlah',
        'tbl_penjualan.total_harga as total_harga',
        'tbl_penjualan.laba as laba',
        'users.name as nama_pegawai',
        'tbl_penjualan.deskripsi as deskripsi',
        'tbl_penjualan.created_at as tanggal']);

        $laba = Penjualan::whereBetween('created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->sum('laba');
        $jumlah = Penjualan::whereBetween('created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->sum('jumlah');

        $pdf = PDF::loadView('pdf.penjualan', ['penjualans' => $penjualan, 'dari' => $dari, 'sampai' => $sampai, 'laba' => $laba, 'jumlah' => $jumlah]);
        return $pdf->stream('Laporan-Data-Penjualan dari '.$dari .' sampai '. $sampai .'.pdf');
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
        $id = $request->id;
        $barang = $request->barang;
        $deskripsi = $request->deskripsi;
        $penjualanData = $request->post(); //tanpa image gini doang
        
        if($request->id == ''){

            if($request->file('img')){
                $this->validate($request, [
                    'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
        
                $filename = time(). '.' . $request->img->extension();
                $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
                // $img_path = $request->file('img')->store('public/img/',$filename);
                $penjualanData['img'] = $filename;
                $penjualan = Penjualan::updateOrCreate($penjualanData);
            }else{                
                $penjualanData['img'] = '';
                $penjualanData['id'] = $id;
                $penjualanData['barang'] = $barang;
                $penjualan = Penjualan::updateOrCreate($penjualanData);
            }
            
            return response()->json(['success' => 'Data Penjualan Telah Ditambah!'], 200);
        }else{

            $findPenjualan = Penjualan::find($id);

            if($request->file('img')){
                $this->validate($request, [
                    'img' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                
                $penjualan_gambar = $findPenjualan->img;

                $img_delete_path = public_path('img/uploaded/').$penjualan_gambar;
                
                File::delete($img_delete_path);

                $filename = time(). '.' . $request->img->extension();
                $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
                // $img_path = $request->file('img')->store('public/img/',$filename);
                $penjualanData = $request->post(); //tanpa image gini doang
                $penjualanData['id'] = $id;
                $penjualanData['img'] = $filename;
                $penjualanData['barang'] = $barang;
                $penjualan = Penjualan::updateOrCreate(['id' => $id],$penjualanData);

                return response()->json(['success' => 'Data Penjualan Telah Diedit!'], 200);

            }else{
                $penjualanData = $request->post(); //tanpa image gini doang
                $penjualanData['id'] = $id;
                $penjualanData['img'] = $findPenjualan->img;
                $penjualanData['barang'] = $barang;
                $penjualan = Penjualan::updateOrCreate(['id' => $id] , $penjualanData);

                return response()->json(['success' => 'Data Penjualan Telah Diedit!'], 200);
            }

    
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penjualan = Penjualan::find($id);
        return response()->json($penjualan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::find($id); //make find()->delete() udah cukup tanpa image atau file
        $penjualan_gambar = $penjualan->img;

        $img_path = public_path('img/uploaded/').$penjualan_gambar;
        
        File::delete($img_path);

        $penjualan->delete();
        
        return response()->json(['success'=> 'Deleted']);

    }
}
