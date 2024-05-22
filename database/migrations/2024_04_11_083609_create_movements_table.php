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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('movement_consumption_cal');
            $table->string('record_type');
            $table->integer('record_weight');
            $table->integer('record_times');
            $table->integer('record_sets');
            $table->integer('record_movement_times');
            $table->timestamp('movement_created_at')->nullable();
            $table->timestamp('movement_updated_at')->nullable();
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
        Schema::dropIfExists('movements');
    }
};
