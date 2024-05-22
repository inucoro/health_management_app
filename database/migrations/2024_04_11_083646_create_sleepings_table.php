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
        Schema::create('sleepings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->double('record_sleeping_time')->nullable();
            $table->string('record_sleeping_memo')->nullable();
            $table->timestamp('sleeping_created_at')->nullable();
            $table->timestamp('sleeping_updated_at')->nullable();
            $table->time('record_wake_up_time');
            $table->time('record_bedtime');
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
        Schema::dropIfExists('sleepings');
    }
};
