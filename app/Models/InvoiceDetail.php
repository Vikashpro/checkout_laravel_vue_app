<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\belongsTo;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id','product_id','quantity','price'
    ];

    public function product():belongsTo{
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
