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
        Schema::create('favorite_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('favorite_movement_created_at')->nullable();
            $table->timestamp('favorite_movement_updated_at')->nullable();
            $table->string('favorite_type')->nullable();
            $table->integer('favorite_weight')->nullable();
            $table->integer('favorite_times')->nullable();
            $table->integer('favorite_sets')->nullable();
            $table->integer('favorite_movement_times')->nullable();
            $table->integer('favorite_movement_consumption_cal')->nullable();
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
        Schema::dropIfExists('favorite_movements');
    }
};
