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
        Schema::create('calenders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('date');
            $table->integer('record_body_weight')->default(0);
            $table->integer('record_body_fat')->default(0);
            $table->integer('record_sleeping_time')->default(0);
            $table->integer('ingestion_cal')->default(0);
            $table->integer('sum_movement_consumption_cal')->default(0);
            $table->string('record_calneder_memo')->nullable();
            $table->timestamp('calender_created_at')->nullable();
            $table->timestamp('calender_updated_at')->nullable();
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
        Schema::dropIfExists('calenders');
    }
};
