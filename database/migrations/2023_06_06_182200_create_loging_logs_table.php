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
        Schema::create('loging_logs', function (Blueprint $table) {
            $table->id();
            $table->text("device_id") -> nullable();
            $table->text("username") -> nullable();
            $table->text("city") -> nullable();
            $table->text("ip") -> nullable();
            $table->text("loc") -> nullable();
            $table->text("browser_id") -> nullable();
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
        Schema::dropIfExists('loging_logs');
    }
};
