<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'customer_id',
        'type',
        'gold_amount',
        'gold_price',
        'total_price',
        'fee',
        'status',
        'description',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions()
    {
        return $this->morphMany(
            WalletTransaction::class,
            'reference'
        );
    }
}
