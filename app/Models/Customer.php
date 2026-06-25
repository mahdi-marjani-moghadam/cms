<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $casts = [
        'phone' => 'array'
    ];

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'province',
        'mobile',
        'location',
        'phone',
        'email',
        'whatsapp',
        'telegram',
        'instagram',
        'image',
        'user_id',
        'status',
        'zipcode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }


    public function getWalletBalances(): array
    {
        $transactions = $this->walletTransactions()
            ->selectRaw("
            wallet_type,
            SUM(
                CASE
                    WHEN operation = 'deposit' THEN amount
                    WHEN operation = 'withdraw' THEN -amount
                    ELSE 0
                END
            ) as balance
        ")
            ->groupBy('wallet_type')
            ->pluck('balance', 'wallet_type');

        return [
            'toman' => (float) ($transactions['toman'] ?? 0),
            'gold' => (float) ($transactions['gold'] ?? 0),
        ];
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }
}
