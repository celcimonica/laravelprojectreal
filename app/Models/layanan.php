<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class layanan extends Model
{
    use HasFactory;

    protected $fillable=['nama','jeniskategori','price','stock','description'];

    // public function category():BelongsTo
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function detil_transaksi():HasMany
    {
        return $this->hasMany(detil_transaksi::class);
    }
}

