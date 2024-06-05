<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PelangganController extends Controller
{
    //
    public function index()
    {
        return view('pelanggan.index', [
            "title" => "Pelanggan",
            "data" => Pelanggan::all()
        ]);
    }    
    public function create():View
    {
        return view('pelanggan.index')->with(["title" => "Tambah Data Pelanggan"]);
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
        ]);
        if (empty($request['nohp'])) {
            $request['nohp']='null';
        if (empty($request['alamat'])) 
            $request['alamat']='null';
        }

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success','Data Pelanggan Berhasil Ditambahkan');
    }

    public function edit(Pelanggan $pelanggan):View
    {
        return view('pelanggan.edit',compact('pelanggan'))->with([
            "title" => "Ubah Data Pelanggan",
        ]);
    }
    public function update(Pelanggan $pelanggan, Request $request):RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
        ]);
        if (empty($request['nohp'])) {
            $request['nohp']='null';
        if (empty($request['alamat'])) 
            $request['alamat']='null';
        }

        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')->with('updated','Data Pelanggan Berhasil Diubah');
    }
    public function show(pelanggan $pelanggan):View
        {
            return view('pelanggan.tampil',compact('pelanggan'))->with(["title" => "Data Pelanggan"]);
        }


}
