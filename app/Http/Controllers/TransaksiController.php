<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Info;
use App\Models\User;
use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use DataTables;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama_barang',function ($row)
        {
            $dataBarang = Barang::find($row->id_barang);

            return $dataBarang->nama;
        })
        ->addColumn('action',function ($row){
            $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-success btn-sm editKeranjang"><i class="fa fa-edit" aria-hidden="true"></i></a>';

            $btn = $btn.' <a href="javascript:void(0)" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKeranjang">
            <i class="fa fa-trash" aria-hidden="true"></i></a>';
            return $btn;
        })
        ->rawColumns(['nama_barang','action'])
        ->make(true);
    }

    public function salonTransaksi(Request $request)
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        
        return view('transaksi.transaksi')->with(['info' => $info, 'barang' => $barang]);
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
        $transaksiData = $request->post(); //tanpa image gini doang 
        
        if($id == ''){
            $transaksi = Transaksi::updateOrCreate($transaksiData);
    
            return response()->json(['success' => 'Data Properti Telah Ditambah!'], 200);
        }else{
            $transaksiData['id'] = $id;
            $transaksi = Transaksi::updateOrCreate(['id' => $id] , $transaksiData);
    
            return response()->json(['success' => 'Data Properti Telah Diedit!'], 200);
        }
    }
    public function savePenjualan(Request $request)
    {
        $allTransaksi = Transaksi::get();

        foreach($allTransaksi as $transaksi){
            $id_barang = $transaksi->id_barang;
            $jumlah = $transaksi->jumlah;
            $total_harga = $transaksi->total;
            $nama_pegawai = $transaksi->nama_pegawai;
            $deskripsi = $transaksi->keterangan;

            $findBarang = Barang::find($id_barang);
            $nama_barang = $findBarang->nama;
            $img = $findBarang->img;
            $jenis = $findBarang->jenis;
            $supplier = $findBarang->supplier;
            $modal = $findBarang->modal;
            $harga_satuan = $findBarang->harga;

            $sisa = $findBarang->sisa;
            $laba = $total_harga - ($modal*$jumlah);
            $jumlahTerjual = $findBarang->jumlah + $jumlah;

            if($findBarang->jenis == 'Barang'){
               $stok = $sisa - $jumlah; 
               $notif = 0;
               if($stok < 10){
                 $notif = 1;
               }
               $findBarang->update([
                'jumlah' => $jumlahTerjual,
                'sisa' => $stok,
                'notif' => $notif
               ]);
            }else if($findBarang->jenis == 'Jasa'){
                $findBarang->update([
                    'jumlah' => $jumlahTerjual,
                ]);
            }

            Penjualan::Create([
                'nama_barang' => $nama_barang,
                'img' => $img,
                'jenis' => $jenis,
                'supplier' => $supplier,
                'modal' => $modal,
                'harga_satuan' => $harga_satuan,
                'jumlah' => $jumlah,
                'total_harga' => $total_harga,
                'laba' => $laba,
                'nama_pegawai' => $nama_pegawai,
                'deskripsi' => $deskripsi,
            ]);
        }

        return response()->json(['success' => 'Data telah ditambah ke penjualan!'], 200);

    }

    public function resetKeranjang()
    {
        Transaksi::truncate();

        return response()->json(['success' => 'Data keranjang telah dihapus!'], 200);
    }
    public function cetakKeranjang($bayar, $kembalian)
    {
        $info = Info::find('1')->first();
        
        $keranjang = Transaksi::join('tbl_barang','tbl_barang.id','=','tbl_keranjang.id_barang')
        // join('tbl_keranjang.id_pegawai','=','tbl_pegawai.id')
                    ->get(['tbl_keranjang.jumlah as jumlah_keranjang','tbl_keranjang.total as total_keranjang','tbl_barang.nama as nama_barang','tbl_barang.harga as harga_barang']);
        
        $tgl_pembelian = Transaksi::first('created_at');
        $kasir = Transaksi::where('nama_pegawai','=',auth()->user()->name)->first();

        $total_harga = Transaksi::selectRaw('SUM(total) as total_harga')->get();
        $total_barang = Transaksi::selectRaw('SUM(jumlah) as total_barang')->get();

        $customPaper = array(0,0,567.00,283.80);

        $pdf = PDF::loadView('pdf.keranjang', ['keranjangs' => $keranjang, 'tgl_pembelian' => $tgl_pembelian, 'kasir' => $kasir , 'total_harga' => $total_harga , 'total_barang' => $total_barang,'info' => $info, 'kembalian' => $kembalian, 'bayar' => $bayar])->setPaper($customPaper, 'landscape');
        return $pdf->stream('Laporan-Data-Transaksi'. date('d-m-Y H_i_s') .'.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Transaksi $transaksi)
    {
        $keranjang = Transaksi::find($id);
        $barang = Barang::find($keranjang->id_barang);

        return response()->json(array(
            'dataKeranjang' => $keranjang,
            'dataBarang' => $barang
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Transaksi $transaksi)
    {
        $transaksi = Transaksi::find($id); //make find()->delete() udah cukup tanpa image atau file

        $transaksi->delete();
        
        return response()->json(['success'=> 'Deleted']);
    }
}
