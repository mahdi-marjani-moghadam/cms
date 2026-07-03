<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldDebtPayment extends Model
{
    protected $fillable = [
        'gold_debt_id',
        'amount',
        'gold_price',
        'gold_weight',
        'payment_method',
        'transaction_id',
        'description',
    ];

    protected $casts = [
        'amount' => 'integer',
        'gold_price' => 'integer',
        'gold_weight' => 'decimal:3',
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function goldDebt()
    {
        return $this->belongsTo(GoldDebt::class);
    }
}
