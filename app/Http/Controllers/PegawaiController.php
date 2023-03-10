<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Info;
use Illuminate\Http\Request;
use DB;
use PDF;
use DataTables;
use File;

class PegawaiController extends Controller
{
    
    public function index(){
        $data = User::latest()->get();
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
        ->addColumn('action',function ($row){
            
            $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelDetail" data-id="'.$row->id.'" data-original-title="Detail" class="btn btn-success btn-sm detailPegawai">Detail</a>';

            $btn = $btn.' <a href="javascript:void(0)" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePegawai">Delete</a>';

            return $btn;
        })
        ->rawColumns(['img','action'])
        ->make(true);
    }
    public function salonPegawai(Request $request)
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        
        return view('pegawai.pegawai')->with(['info' => $info, 'barang' => $barang]);
    }
    public function destroy($id)
    {
        $pegawai = User::find($id); //make find()->delete() udah cukup tanpa image atau file
        if($pegawai->level == 1){
            return response()->json(['error'=> 'Akun ini tidak bisa dihapus.']);
        }else{
            $pegawai_gambar = $pegawai->img;
    
            $img_path = public_path('img/uploaded/').$pegawai_gambar;
            
            File::delete($img_path);
    
            $pegawai->delete();
            
            return response()->json(['success'=> 'Deleted']);
        }
    }
    public function destroyImg($id)
    {
        $pegawai = User::find($id); //make find()->delete() udah cukup tanpa image atau file
        
        $pegawai_gambar = $pegawai->img;

        $img_path = public_path('img/uploaded/').$pegawai_gambar;
        
        File::delete($img_path);
        $pegawai->img='';
        $pegawai->save();
        
        return response()->json(['success'=> 'Deleted image']);
                
    }
    public function cetakPegawai($dari, $sampai, $opsi)
    {
        if($opsi == 'pick'){
            $waktu_dari = ' 00:00:00';
            $waktu_sampai = ' 23:59:59';
            
        }else if($opsi == 'bulanan'){
            $waktu_dari = ' 00:00:00';
            $waktu_sampai = ' 00:00:00';
        }
        
        $pegawai = User::whereBetween('created_at', [$dari.$waktu_dari, $sampai . $waktu_sampai])
        ->get();
        
        $pdf = PDF::loadView('pdf.pegawai', ['pegawais' => $pegawai, 'dari' => $dari, 'sampai' => $sampai]);
        return $pdf->stream('Laporan-Data-Pegawai dari '.$dari .' sampai '. $sampai .'.pdf');
    }
    
    public function edit($id)
    {
        $pegawai = User::find($id);
        return response()->json($pegawai);
    }

}
