<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldDebt extends Model
{
    const ACTIVE = 0;
    const PAID = 1;
    const CANCELED = -1;

    protected $fillable = [
        'order_id',
        'customer_id',
        'gold_price_at_order',
        'total_gold',
        'status',
    ];

    protected $casts = [
        'gold_price_at_order' => 'integer',
        'total_gold' => 'decimal:3',
    ];

    public function payments()
    {
        return $this->hasMany(GoldDebtPayment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getRemainingDebtAttribute()
    {
        $paid = $this->payments()->sum('gold_weight');
        return max(0, $this->total_gold - $paid);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }
}
