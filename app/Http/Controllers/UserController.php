<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    
public function index()
    {
        return view('user.index',[
            "title"=>"Data Pengguna",
            "data"=>User::all()
        ]);
    }
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
            "username"=>"required",
            "password"=>"required",
            "foto"=>"required"
            
        ]);

        $password=Hash::make($request->password);
        $request->merge([
            "password"=>$password
        ]);
        // $foto=$_FILES['foto'] ['nama'];
        // $file_tmp=$_FILES['foto'] ['tmp_nama'];
        // move_uploaded_file($file_tmp, '../../fotouser/'.$foto);
        // User::create($request->all());
        
        return redirect()->route('pengguna.index')->with('success','Data User Berhasil Ditambahkan');
    }
}
