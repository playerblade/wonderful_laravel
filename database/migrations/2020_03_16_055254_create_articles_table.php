<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_category_id');
//            $table->unsignedBigInteger('makers_id');
            $table->string('title');
            $table->string('marker');
            $table->string('description');
            $table->integer('stock');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
//            $table->foreign('makers_id')->references('id')->on('makers')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
}
