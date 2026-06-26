<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'customer_id',
        'wallet_type', // toman//gold
        'operation', // deposit//withdraw//purchase//refund//adjustment
        'amount',
        'reference_type',
        'reference_id',
        'description',
    ];
    public function reference()
    {
        return $this->morphTo();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
