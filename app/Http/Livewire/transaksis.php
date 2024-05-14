<?php

namespace App\Http\Livewire;

use App\Models\transaksi;
use App\Models\detil_transaksi;
use App\Models\layanan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;


class transaksis extends Component
{
    public $total;
    public $transaksi_id;
    public $layanan_id;
    public $qty=1;
    public $uang;
    public $kembali;
    public function render()
    {
        $transaksi=transaksi::select('*')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->first();

        $this->total=$transaksi->total;
        $this->kembali=$this->uang-$this->total;
        return view('livewire.transaksis')
        ->with("data",$transaksi)
        ->with("datalayanan",layanan::where('stock','>','0')->get())
        ->with("datadetil_transaksi",detil_transaksi::where('transaksi_id','=',$transaksi->id)->get());
    }

    public function store()
    {
        $this->validate([

            'layanan_id'=>'required'
        ]);
        $transaksi=transaksi::select('*')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->first();
        $this->transaksi_id=$transaksi->id;
        $layanan=layanan::where('id','=',$this->layanan_id)->get();
        $harga=$layanan[0]->price;
        detil_transaksi::create([
            'transaksi_id'=>$this->transaksi_id,
            'layanan_id'=>$this->layanan_id,
            'qty'=>$this->qty,
            'price'=>$harga
        ]);

        $total=$transaksi->total;
        $total=$total+($harga*$this->qty);
        transaksi::where('id','=',$this->transaksi_id)->update([
            'total'=>$total
        ]);
        $this->layanan_id=NULL;
        $this->qty=1;
          
    }
        public function delete($detil_transaksi_id)
        {
            $detil_transaksi=detil_transaksi::find($detil_transaksi_id);
            $detil_transaksi->delete();

            //update total
            $detil_transaksi=detil_transaksi::select('*')->where('transaksi_id','=',$this->transaksi_id)->get();
            $total=0;
            foreach($detil_transaksi as $od){
                $total+=$od->qty*$od->price;
            }

            try{
                transaksi::where('id','=',$this->transaksi_id)->update([
                    'total'=>$total
                ]);
            }catch(Exception $e){
                dd($e);
            }
        }
    
        public function receipt($id)
        {
            //update stok
            $detil_transaksi = detil_transaksi::select('*')->where('transaksi_id','=', $id)->get();
            //dd($detil_transaksi);
            foreach ($detil_transaksi as $od){
                $stocklama = layanan::select('stock')->where('id','=', $od->layanan_id)->sum('stock');
                $stock = $stocklama - $od->qty;
                try {
                    layanan::where('id','=', $od->layanan_id)->update([
                        'stock'=> $stock
                    ]);
                } catch (Exception $e){
                    dd($e);
                }
            }
            return Redirect::route('cetakReceipt')->with(['id' => $id]);
        }
}
