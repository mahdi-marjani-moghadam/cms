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
        Schema::create('gold_debts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // قیمت هر گرم هنگام ثبت فاکتور
            $table->unsignedBigInteger('gold_price_at_order');

            // مجموع بدهی به گرم
            $table->decimal('total_gold', 12, 3);

            // 0: GoldDebt::ACTIVE | 1: GoldDebt::PAID | -1: GoldDebt::CANCELED
            $table->tinyInteger('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gold_debts');
    }
};
