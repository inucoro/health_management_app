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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('record_menu');
            $table->integer('record_cal');
            $table->integer('record_protein');
            $table->integer('record_fat');
            $table->integer('record_carbo');
            $table->timestamp('meal_created_at')->nullable();
            $table->timestamp('meal_updated_at')->nullable();
            $table->string('favorite_menu');
            $table->integer('favorite_cal');
            $table->integer('favorite_protein');
            $table->integer('favorite_fat');
            $table->integer('favorite_carbo');
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
        Schema::dropIfExists('meals');
    }
};
