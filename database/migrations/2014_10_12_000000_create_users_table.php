<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('ci');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('last_name');
            $table->string('mother_last_name');
            $table->enum('gender',['M','F']);
            $table->integer('phone_number');
            $table->date('birthday');
            $table->string('user', 40)->unique();
            $table->string('password');
            $table->boolean('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
