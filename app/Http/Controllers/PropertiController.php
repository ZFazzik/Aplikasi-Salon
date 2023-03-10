<?php

namespace App\Http\Controllers;

use App\Models\Properti;
use App\Models\Barang;
use App\Models\Info;
use Illuminate\Http\Request;
use DataTables;

class PropertiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = Properti::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function ($row){
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelId" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm editProperti">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-target="#modelId"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProperti">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function salonProperti()
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();
        
        return view('admin.properti')->with(['info' => $info, 'barang' => $barang]);
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
        $propertiData = $request->post(); //tanpa image gini doang 

        if($id == ''){
            $properti = Properti::updateOrCreate($propertiData);
    
            return response()->json(['success' => 'Data Properti Telah Ditambah!'], 200);
        }else{
            $propertiData['id'] = $id;
            $properti = Properti::updateOrCreate(['id' => $id] , $propertiData);
    
            return response()->json(['success' => 'Data Properti Telah Diedit!'], 200);
        }

        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Properti  $properti
     * @return \Illuminate\Http\Response
     */
    public function show(Properti $properti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Properti  $properti
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Properti $properti)
    {
        $properti = Properti::find($id);
        return response()->json($properti);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Properti  $properti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Properti $properti)
    {
        //
    }

    public function findType($type){
        $findType = Properti::where('type',$type)->get();

        return response()->json($findType);
    }
    public function findBarang($jenis){
        $findBarang = Barang::where('jenis',$jenis)->get();
        
        return response()->json($findBarang);
    }
    public function findBarangId($id){
        $findBarang = Barang::where('id',$id)->get(); 
        
        return response()->json($findBarang);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Properti  $properti
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Properti $properti)
    {
        $properti = Properti::find($id); //make find()->delete() udah cukup tanpa image atau file
        
        if($properti->nama == 'Jasa' || $properti->nama == 'Barang'){
            return response()->json(['error'=> 'Failed to delete']);
        }else{
            $properti->delete();
            return response()->json(['success'=> 'Deleted']);
        }

    }
}
