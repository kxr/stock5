<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('item_id')->unsigned();
            $table->integer('sinv_id')->unsinged();
            $table->float('unit_price');
            $table->float('quantity');
            $table->text('note');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('sinv_id')->references('id')->on('sinv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stransactions');
    }
}
