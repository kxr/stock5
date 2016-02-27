<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayments2invTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opayments2pinv', function (Blueprint $table) {

            $table->integer('pinv_id')->unsigned();
            $table->integer('opayment_id')->unsigned();
            $table->foreign('pinv_id')->references('id')->on('pinv');
            $table->foreign('opayment_id')->references('id')->on('opayemnts');

            $table->timestamps();
        });
        Schema::create('ipayments2sinv', function (Blueprint $table) {

            $table->integer('sinv_id')->unsigned();
            $table->integer('ipayment_id')->unsigned();
            $table->foreign('sinv_id')->references('id')->on('sinv');
            $table->foreign('ipayment_id')->references('id')->on('payemnts');

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
        Schema::drop('opayments2pinv');
        Schema::drop('ipayments2sinv');
    }
}
