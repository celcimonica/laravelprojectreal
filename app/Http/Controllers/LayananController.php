<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\layanan;

class layananController extends Controller
{
    //
    public function index()
    {
        $layanan=layanan::all();
        return view('layanan.index', [
            "title" => "layanan",
            "data" => $layanan
        ]);
    }
    public function create(): View
    {
        return view('layanan.create')->with([
            "title" => "Tambah Data layanan",
        ]);
    }

    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
            "price"=>"required",
            "jeniskategori"=>"required",
            "description"=>"nullable",
        ]);

        layanan::create($request->all());
        return redirect()->route('layanan.index')->with('success','Data layanan Berhasil Ditambahkan');
    }

    public function edit(layanan $layanan):View
    {
        return view('layanan.edit',compact('layanan'))->with([
            "title"=>"Ubah Data layanan",
            // "data"=>Category::all()
        ]);
    }

    public function update(layanan $layanan, Request $request):RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
            "price"=>"required",
            "jeniskategori"=>"required",
            "description"=>"nullable",
        ]);

        $layanan->update($request->all());
        return redirect()->route('layanan.index')->with('updated','Data layanan Berhasil Diubah');
    }

    public function show():View
    {
        $layanan=layanan::all();
        return view('layanan.show')->with([
            "title"=>"Tampil Data layanan",
            "data"=>$layanan
        ]);
    }

    public function destroy($id):RedirectResponse
    {
        layanan::where('id',$id)->delete();
        return Redirect()->route('layanan.index')->with('deleted','Data layanan Berhasil Dihapus');
    }
}
