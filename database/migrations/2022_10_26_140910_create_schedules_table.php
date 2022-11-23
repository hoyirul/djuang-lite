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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->text('pickup_address')->nullable();
            $table->text('destination_address')->nullable();
            $table->text('pickup_return_address')->nullable();
            $table->time('time_pickup')->nullable();
            $table->time('time_return')->nullable();
            $table->text('information')->nullable();
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
        Schema::dropIfExists('schedules');
    }
};
