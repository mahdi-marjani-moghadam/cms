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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->enum('wallet_type', ['rial', 'gold'])
                ->index();

            $table->enum('operation', [
                'deposit',      // افزایش اعتبار
                'withdraw',     // برداشت اعتبار
                'purchase',     // خرید
                'refund',       // برگشت
                'adjustment'    // اصلاح دستی
            ])->index();

            $table->decimal('amount', 18, 4);

            $table->nullableMorphs('reference');
            // reference_type
            // reference_id

            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['customer_id', 'wallet_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
