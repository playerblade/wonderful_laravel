<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('db1')->create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_accounts_id');
            $table->unsignedBigInteger('transaction_type_id');
            $table->integer('mount_transaction');
            $table->timestamps();
            $table->foreign('bank_accounts_id')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
