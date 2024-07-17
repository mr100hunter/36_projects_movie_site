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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('login_time') -> default(1);
            $table->string('expired') -> default(1);
            $table->string('creator_role') -> default(1);
            $table->string('role') -> default(0);
            $table->string('uniqeID') -> default(0);
            $table->string('user_adult') -> default("yes");
            $table->string('access') -> default("all");
            $table->string('products_access') -> default(0);
            $table->string('slider') -> default(0);
            $table->text('note') -> nullable();
            $table->string('st') -> default("active");
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
        Schema::dropIfExists('users');
    }
};
