<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable=['invoice','pelanggan_id','user_id','total'];

    public function detil_transaksi():HasMany
    {
        return $this->hasMany(detil_transaksi::class);
    }

    public function pelanggan():BelongsTo
    {
        return $this->belongsTo(pelanggan::class);
    }
}
