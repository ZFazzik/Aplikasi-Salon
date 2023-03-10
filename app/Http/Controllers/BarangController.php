<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Info;
use Illuminate\Http\Request;
use DB;
use PDF;
use DataTables;
use File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('img',function ($row){
            if($row->img){
                $url = asset('/img/uploaded/'.$row->img);
            }else{
                $url = asset('/img/No_image_available.png');
            }
            $img = "<img src='".$url."' class='img-thumbnail rounded-top' alt=''>";
    
            return $img;
        })
        ->addColumn('total_modal',function ($row){
            if($row->jenis != 'Jasa'){
                $modal = $row->modal * ($row->jumlah + $row->sisa);
            }else{
                $modal = 0;
            }
    
            return $modal;
        })
        ->addColumn('total_laba',function ($row){
            $laba = ($row->harga * $row->jumlah) - ($row->modal * $row->jumlah);
    
            return $laba;
        })
        ->addColumn('action',function ($row){
            
            $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelDetail" data-id="'.$row->id.'" data-original-title="Detail" class="btn btn-success btn-sm detailBarang">Detail</a>';
            
            if(auth()->user()->level == 1):
                
            $btn = $btn. ' <a href="javascript:void(0)" data-toggle="modal" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm editBarang">Edit</a>';

            $btn = $btn.' <a href="javascript:void(0)" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBarang">Delete</a>';

            endif;

            return $btn;
        })
        ->rawColumns(['total_modal','img','action'])
        ->make(true);
    }
    public function detailBarang($id)
    {
        //
    }
    public function salonBarang(Request $request)
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        
        return view('barang.barang')->with(['info' => $info, 'barang' => $barang]);
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
        $nama = $request->nama;
        $barangData = $request->post(); //tanpa image gini doang
        
        if($request->id == ''){

            if($request->file('img')){
                $this->validate($request, [
                    'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
        
                $filename = time(). '.' . $request->img->extension();
                $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
                // $img_path = $request->file('img')->store('public/img/',$filename);
                $barangData['img'] = $filename;
                $barangData['notif'] = 0;
                $barang = Barang::updateOrCreate($barangData);
            }else{                
                $barangData['img'] = '';
                $barangData['id'] = $id;
                $barangData['nama'] = $nama;
                $barangData['notif'] = 0;
                $barang = Barang::updateOrCreate($barangData);
            }
            
            return response()->json(['success' => 'Data Barang Telah Ditambah!'], 200);
        }else{

            $findPenjualan = Barang::find($id);

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

                if($barangData['jenis'] == 'Jasa'){
                    $barangData['supplier'] = null;
                    $barangData['modal'] = null;
                    $barangData['sisa'] = null;

                    $penjualan_gambar = $findPenjualan->img;

                    $img_delete_path = public_path('img/uploaded/').$penjualan_gambar;
                    
                    File::delete($img_delete_path);
                    $barangData['img'] = '';
                }else{
                    $barangData['img'] = $filename;
                }

                $barangData['id'] = $id;
                $barang = Barang::updateOrCreate(['id' => $id],$barangData);

                return response()->json(['success' => 'Data Barang Telah Diedit!'], 200);

            }else{
                if($barangData['jenis'] == 'Jasa'){
                    $barangData['supplier'] = null;
                    $barangData['modal'] = null;
                    $barangData['sisa'] = null;

                    $penjualan_gambar = $findPenjualan->img;

                    $img_delete_path = public_path('img/uploaded/').$penjualan_gambar;
                    
                    File::delete($img_delete_path);
                    $barangData['img'] = '';
                }else{
                    $barangData['img'] = $findPenjualan->img;
                }
                
                $barangData['id'] = $id;
                $barang = Barang::updateOrCreate(['id' => $id] , $barangData);

                return response()->json(['success' => 'Data Barang Telah Diedit!'], 200);
            }

    
        }

        
    }
    public function cetakBarang($dari, $sampai, $opsi)
    {
        if($opsi == 'pick'){
            $waktu_dari = ' 00:00:00';
            $waktu_sampai = ' 23:59:59';
            
        }else if($opsi == 'bulanan'){
            $waktu_dari = ' 00:00:00';
            $waktu_sampai = ' 00:00:00';
        }
        
        $barang = Barang::whereBetween('created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->get();
        
        $sisa = Barang::whereBetween('created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->sum('sisa');
        $jumlah = Barang::whereBetween('created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->sum('jumlah');
        $laba =  Penjualan::join('tbl_barang','tbl_barang.id','=','tbl_penjualan.id_barang')
        ->whereBetween('tbl_barang.created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->get(['tbl_penjualan.laba as laba']);
        
        $pdf = PDF::loadView('pdf.barang', ['barangs' => $barang, 'dari' => $dari, 'sampai' => $sampai, 'sisa' => $sisa, 'jumlah' => $jumlah , 'laba' => $laba->sum('laba')]);
        return $pdf->stream('Laporan-Data-Barang dari '.$dari .' sampai '. $sampai .'.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Barang $barang)
    {
        $barang = Barang::find($id); //make find()->delete() udah cukup tanpa image atau file
        $barang_gambar = $barang->img;

        $img_path = public_path('img/uploaded/').$barang_gambar;
        
        File::delete($img_path);

        $barang->delete();
        
        return response()->json(['success'=> 'Deleted']);
    }

    public function destroyImg($id)
    {
        $barang = Barang::find($id); //make find()->delete() udah cukup tanpa image atau file
        
        $barang_gambar = $barang->img;

        $img_path = public_path('img/uploaded/').$barang_gambar;
        
        File::delete($img_path);
        $barang->img='';
        $barang->save();
        
        return response()->json(['success'=> 'Deleted image']);
    }

    public function destroyNotif($id)
    {
        $barang = Barang::find($id);

        $barang->notif=0;
        $barang->save();
        return response()->json(['success'=> 'Deleted notif']);
    }
}
