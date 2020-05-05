<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $schema;

    // public function __construct()
    // {
    //     $this->schema = Schema::connection(config('database.connection_payment_online'));
    // }

    public function up()
    {
        // Schema::create('bank_accounts', function (Blueprint $table) {
        Schema::connection('db1')->create('bank_accounts', function (Blueprint $table) {
        // $this->schema->create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('account_number');
            $table->integer('monto');
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
        Schema::dropIfExists('bank_accounts');
    }
}
