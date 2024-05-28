<?php

namespace App\Http\Controllers;


use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\transaksi;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $layanan = Layanan::count();
        $pelanggan = Pelanggan::count();
        $user = User::count();
        $datatransaksi = transaksi::count();

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        $data_tanggal = array();
        $data_pendapatan = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

            $total_transaksi = transaksi::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('total');

            $pendapatan = $total_transaksi;
            $data_pendapatan[] += $pendapatan;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

        return view('welcome',[
          
            "pelanggan"=> $pelanggan,
         
            "layanan"=> $layanan,
            "user"=> $user,
            "datatransaksi" => transaksi::paginate(5),
            "title"=>"welcome"
        ]);
        
    }

    
}
