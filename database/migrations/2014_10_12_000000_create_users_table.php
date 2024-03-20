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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('age')->nullable();
            $table->unsignedBigInteger('telephone')->nullable();
            $table->unsignedBigInteger('puntos')->default(0);
            $table->unsignedBigInteger('nivel_id')->default(1)->nullable();
            $table->foreign('nivel_id')->references('id')->on('niveles')->onDelete('cascade');
            $table->unsignedBigInteger('experience')->default(0);
            $table->rememberToken();
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
