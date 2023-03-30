<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Barang;
use Illuminate\Http\Request;
use File;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salonInfo()
    {
        $info = Info::find('1')->first();
        $barang = Barang::where('notif', '!=', 0)
        ->where('jenis', '=', 'Barang')
        ->get();

        return view('admin.info')->with(['info' => $info, 'barang' => $barang]);
    }
    public function changeInfo(Request $request)
    {
        $info = Info::find($request->id)->first();
        $nama_web = $request->nama_web;
        $alamat = $request->alamat;
        $sosmed = $request->sosmed;
        $cabang = $request->cabang;
        if($request->file('img') && $request->file('img_loginscreen')){
            $this->validate($request, [
                'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'img_loginscreen' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $img_delete_path = public_path('img/uploaded/').$info->icon_web;
            $img_delete_path2 = public_path('img/uploaded/').$info->loginscreen_web;
        
            File::delete($img_delete_path);
            File::delete($img_delete_path2);
            $filename = time(). '.' . $request->img->extension();
            $filename2 = time(). '.' . $request->img_loginscreen->extension();
            $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
            $img_path2 = $request->img_loginscreen->move(public_path('img/uploaded/'), $filename2);
            $img = $filename;
            $img2 = $filename2;
        }else if($request->file('img') && !$request->file('img_loginscreen')){
            $this->validate($request, [
                'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $img_delete_path = public_path('img/uploaded/').$info->icon_web;
        
            File::delete($img_delete_path);
            $filename = time(). '.' . $request->img->extension();
            $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
            $img = $filename;
            $img2 = $info->loginscreen_web;
        }else if(!$request->file('img') && $request->file('img_loginscreen')){
            $this->validate($request, [
                'img_loginscreen' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $img_delete_path2 = public_path('img/uploaded/').$info->loginscreen_web;
        
            File::delete($img_delete_path2);
            $filename2 = time(). '.' . $request->img_loginscreen->extension();
            $img_path2 = $request->img_loginscreen->move(public_path('img/uploaded/'), $filename2);
            $img = $info->icon_web;
            $img2 = $filename2;
        }else{
            $img = $info->icon_web;
            $img2 = $info->loginscreen_web;
        }

    $info = Info::find($request->id)->update([
        'nama_web' => $nama_web,
        'alamat' => $alamat,
        'sosmed' => $sosmed,
        'cabang' => $cabang,
        'icon_web' => $img,
        'loginscreen_web' => $img2,
    ]);
    
    return redirect()->route('info')->with('success', "Info Web sudah diubah.");
    }

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
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Info $info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        //
    }
}
