<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gold_debt_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gold_debt_id')->constrained()->cascadeOnDelete();

            // transaction morphable

            // مبلغ پرداختی (تومان)
            $table->unsignedBigInteger('amount');

            // قیمت طلا هنگام پرداخت
            $table->unsignedBigInteger('gold_price');

            // معادل طلای این پرداخت
            $table->decimal('gold_weight', 12, 3);

            // درگاه، کارتخوان، نقدی، کارت به کارت...
            $table->string('payment_method', 50)->nullable();

            // در صورت داشتن تراکنش
            $table->foreignId('transaction_id')
                ->nullable()
                ->constrained('transactions')
                ->nullOnDelete();

            $table->text('description')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gold_debt_payments');
    }
};
