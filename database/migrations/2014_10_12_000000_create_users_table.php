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
            $table->string('name')->default('太郎');
            $table->string('sex')->default('male');
            $table->integer('height')->default('170');
            $table->integer('body_weight')->default('60');
            $table->integer('age')->default('20');
            $table->string('image_path')->nullable();
            $table->integer('target_body_weight')->default('70');
            $table->integer('target_cal')->default('2000');
            $table->integer('target_protein')->default('130');
            $table->integer('target_fat')->default('60');
            $table->integer('target_carbo')->default('300');
            $table->integer('target_movement_consumption_cal')->default('500');
            $table->integer('target_sleeping_time')->default('8');
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
