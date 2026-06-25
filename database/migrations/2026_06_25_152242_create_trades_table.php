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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', [
                'buy',
                'sell',
            ]);

            // مقدار طلا
            $table->decimal('gold_amount', 20, 3);

            // قیمت هر گرم
            $table->unsignedBigInteger('gold_price');

            // مبلغ نهایی معامله
            $table->unsignedBigInteger('total_price');

            // کارمزد (اختیاری)
            $table->unsignedBigInteger('fee')
                ->default(0);

            $table->enum('status', [
                'pending',
                'completed',
                'failed',
                'cancelled',
            ])->default('completed');

            $table->string('description')
                ->nullable();

            $table->timestamps();

            $table->index(['customer_id', 'type']);
            $table->index(['customer_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
