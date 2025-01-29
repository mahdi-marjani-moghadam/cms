<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->unsignedBigInteger('content_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name')->nullable();
            $table->text('comment')->nullable();
            $table->string('rate')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('company_id')->references('id')->on('companies')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
