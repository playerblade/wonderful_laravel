<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStatusOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('user_status_orders', function (Blueprint $table) {
        Schema::connection('mysql')->create('user_status_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_order_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('status_order_id')->references('id')->on('status_orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_status_orders');
    }
}
