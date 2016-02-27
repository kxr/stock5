<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinv', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('vendor_id')->unsigned();
            $table->string('lpo');
            $table->string('invoice');
            $table->float('discount')->unsigned();
            $table->text('note');
            $table->integer('payment_id')->unsigned();
            $table->text('status');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('payment_id')->references('id')->on('payments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pinv');
    }
}
