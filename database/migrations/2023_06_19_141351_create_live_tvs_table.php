<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_tvs', function (Blueprint $table) {
            $table->id();
            $table->string("name") -> default('products name');
            $table->string("pic") -> default('products.png');
            // links & expired
            $table->string("links1") -> default('links');
            $table->string("expired1") -> default('00');

            $table->string("links2") -> default('links');
            $table->string("expired2") -> default('00');
           
            $table->string("links3") -> default('links');
            $table->string("expired3") -> default('00');

            $table->string("links4") -> default('links');
            $table->string("expired4") -> default('00');

            $table->string("content18") -> default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_tvs');
    }
};
