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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->bigInteger('customer_id')->nullable();
            // $table->foreign('customer_id')->references('id')->on('users');
            $table->bigInteger('driver_id')->nullable();
            // $table->foreign('driver_id')->references('id')->on('users');
            $table->foreignId('schedule_id')->constrained();
            $table->date('order_date')->nullable();
            $table->float('total');
            $table->enum('status', ['pending', 'processing', 'done'])->default('pending');
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
        Schema::dropIfExists('orders');
    }
};
