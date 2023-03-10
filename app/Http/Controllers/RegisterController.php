<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Info;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use File;
use PDF;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $info = Info::find('1')->first();
        
        return view('general.register')->with(['info' => $info]);
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->validated());

        // auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function hubungiAdmin()
    {
        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function changeProfile(ProfileRequest $request)
    {
        $user = User::find($request->id);
        if($request->new_password != '' || $request->new_password != null){
                if(Hash::check($request->password,$user->password)){
                    if($request->file('img')){
                        $this->validate($request, [
                            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                        ]);
                        $rules=[
                            'new_password' => 'min:8',
                            'password_confirmation' => 'same:new_password',
                        ];
                        $img_delete_path = public_path('img/uploaded/').auth()->user()->img;
                    
                        File::delete($img_delete_path);
                        $filename = time(). '.' . $request->img->extension();
                        $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
                        $img = $filename;
                    }else{
                        $img = auth()->user()->img;
                        $rules=[
                            'new_password' => 'min:8',
                            'password_confirmation' => 'same:new_password',
                        ];
                    }

                $messages = [
                    'password_confirmation.same' => 'Konfirmasi Password harus sama dengan Password Baru.',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator->messages());
                }
                $user = User::find($request->id)->update([
                    'name' => $request->name,
                    'hp' => $request->hp,
                    'alamat' => $request->alamat,
                    'img' => $img,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $request->new_password,
                ]);
                Session::flush();
                
                Auth::logout();
                
                return redirect('/')->with('success', "Password dan Profile sudah diubah, silahkan login kembali.");
            }else{
                return back()->withInput()->withErrors('Password salah. Harap cek ulang.');
            }
            
        }else{
            if(Hash::check($request->password,$user->password)){
                if($request->file('img')){
                    $this->validate($request, [
                        'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);

                    $img_delete_path = public_path('img/uploaded/').auth()->user()->img;
                
                    File::delete($img_delete_path);

                    $filename = time(). '.' . $request->img->extension();
                    $img_path = $request->img->move(public_path('img/uploaded/'), $filename);
                    $img = $filename;
                }else{
                    $img = auth()->user()->img;
                }
                $request->validated();
        
                $user = User::find($request->id)->update([
                    'name' => $request->name,
                    'hp' => $request->hp,
                    'alamat' => $request->alamat,
                    'img' => $img,
                    'username' => $request->username,
                    'email' => $request->email,
                ]);
                
                return back()->with('success', "Profile sudah diubah.");
            }else{
                return back()->withInput()->withErrors('Password salah. Harap cek ulang.');
            }

        }
        

        
    }
}
