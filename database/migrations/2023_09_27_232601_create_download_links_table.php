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
        Schema::create('download_links', function (Blueprint $table) {
            $table->id();
            $table->string("main_title") -> nullable();
            $table->string("video") -> nullable();
            $table->string("file_name") -> nullable();
            $table->string("file_size") -> nullable();
            $table->string("download_btn") -> nullable();
            $table->string("download_links") -> nullable();
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
        Schema::dropIfExists('download_links');
    }
};
