<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('pinv_id')->unsigned();
            $table->float('unit_price')->unsigned();
            $table->float('quantity')->unsigned();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('pinv_id')->references('id')->on('pinv');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ptransactions');
    }
}
