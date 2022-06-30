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
        Schema::create('worker_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('workerId');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('bio')->nullable();
            $table->string('belge')->nullable();
            $table->string('photo')->nullable();
            $table->string('il')->nullable();
            $table->string('ilce')->nullable();
            $table->integer('isAccept')->default(0);
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
        Schema::dropIfExists('worker_profiles');
    }
};
