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

            $table->enum('wallet_type', ['toman', 'gold'])->index();

            $table->enum('operation', [
                'deposit',      // افزایش اعتبار
                'withdraw',     // برداشت اعتبار
            ])->index();

            $table->decimal('amount', 18, 3);

            $table->nullableMorphs('reference');
            /**
                OnlinePayment::class
                Trade::class
                Order::class
                AdminAdjustment::class
            */

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
