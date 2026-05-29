<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->string('lastname', 191)->nullable();
            $table->text('comment')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat');
    }
};
