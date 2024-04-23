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
        Schema::create('favorite_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('favorite_meal_created_at')->nullable();
            $table->timestamp('favorite_meal_updated_at')->nullable();
            $table->string('favorite_menu')->nullable();
            $table->integer('favorite_cal')->nullable();
            $table->integer('favorite_protein')->nullable();
            $table->integer('favorite_fat')->nullable();
            $table->integer('favorite_carbo')->nullable();
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
        Schema::dropIfExists('favorite_meals');
    }
};
