<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name', 'company', 'address', 'email', 'phone' 
    ];

    public function invoiceDetail():hasMany{
        return $this->hasMany(\App\Models\InvoiceDetail::class, 'invoice_id');
    }
}
