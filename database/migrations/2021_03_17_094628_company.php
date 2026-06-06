<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('name')->nullable();
            $table->unsignedBigInteger('parent_id')->default(Null)->nullable();
            $table->text('description')->nullable();
            $table->string('manager')->nullable();
            $table->string('sale_manager')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('logo',255)->nullable();
            $table->string('location')->nullable();
            $table->integer('viewCount')->default('0');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->default(NULL)->nullable();
            $table->text('meta_description')->default(NULL)->nullable();
            $table->integer('status')->default(0);


            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('parent_id')->references('id')->on('contents')
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
        Schema::dropIfExists('companies');

    }
}



// فیلد slug
/*
ALTER TABLE companies ADD COLUMN slug VARCHAR(255) AFTER name;

ALTER TABLE companies ADD UNIQUE (slug);


بعد فیلد رواپیدت کردم
SET @slug := '';
SET @rn := 0;

UPDATE companies c
JOIN (
    SELECT
        id,
        slug,
        @rn := IF(@slug = slug, @rn + 1, 0) AS rn,
        @slug := slug
    FROM companies
    ORDER BY slug, id
) x ON c.id = x.id
SET c.slug = IF(x.rn = 0, x.slug, CONCAT(x.slug, '-', x.rn));

*/
