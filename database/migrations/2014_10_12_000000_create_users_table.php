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
            $table->string('sex');
            $table->integer('height');
            $table->integer('body_weight');
            $table->integer('age');
            $table->string('image_path')->nullable();
            $table->integer('target_body_weight');
            $table->integer('target_cal');
            $table->integer('target_protein');
            $table->integer('target_fat');
            $table->integer('target_carbo');
            $table->integer('target_movement_comsumption_cal');
            $table->integer('target_sleeping_time');
            $table->timestamp('user_created_at')->nullable();
            $table->timestamp('user_updated_at')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
