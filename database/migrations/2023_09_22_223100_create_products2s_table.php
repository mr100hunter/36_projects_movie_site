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
        Schema::create('products2s', function (Blueprint $table) {
            $table->id();
            $table->string("name") -> default('products name');
            $table->string("pic") -> default('products.png');
            $table->string("links") -> default('links');
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
        Schema::dropIfExists('products2s');
    }
};
