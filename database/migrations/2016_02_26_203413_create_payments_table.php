<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opayments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('vendor_id')->unsigned();
            $table->integer('total');
            $table->enum('type', ['cash', 'cheque', 'other']);
            $table->string('cheque_bank');
            $table->bigInteger('cheque_no');
            $table->date('cheque_date');
            $table->string('receivedby');
            $table->text('note');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
        Schema::create('ipayments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('client_id')->unsigned();
            $table->integer('total');
            $table->enum('type', ['cash', 'cheque', 'other']);
            $table->string('cheque_bank');
            $table->bigInteger('cheque_no');
            $table->date('cheque_date');
            $table->string('receivedby');
            $table->text('note');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('opayments');
        Schema::drop('ipayments');
    }
}
