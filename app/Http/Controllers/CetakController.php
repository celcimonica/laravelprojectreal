<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use Illuminate\View\View;
use App\Models\detil_transaksi;

class CetakController extends Controller
{
    //

    public function receipt():View
    {
        $id=session()->get('id');

        $transaksi=transaksi::find($id);
        //dd ($transaksi)
        $detil_transaksi=detil_transaksi::where('transaksi_id',$id)->get();
        return view('penjualan.receipt')->with([
            'datatransaksi'=>$transaksi,
            'datadetil_transaksi'=>$detil_transaksi
        ]);
    }
}
