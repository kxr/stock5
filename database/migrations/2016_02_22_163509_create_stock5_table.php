<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
            $table->text('details');
            $table->timestamps();
        });
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
            $table->text('details');
            $table->timestamps();
        });
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

        Schema::create('igroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('color');
            $table->string('make');
            $table->string('size');
            $table->integer('sale_price');
            $table->string('note');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('igroups');
        });

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

        Schema::create('opayments2pinv', function (Blueprint $table) {

            $table->integer('pinv_id')->unsigned();
            $table->integer('opayment_id')->unsigned();
            $table->timestamps();

            $table->foreign('pinv_id')->references('id')->on('pinv');
            $table->foreign('opayment_id')->references('id')->on('opayemnts');
        });


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

        Schema::create('sinv', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('client_id')->unsigned();
            $table->float('discount')->unsigned();
            $table->text('note');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
        });

        Schema::create('ipayments2sinv', function (Blueprint $table) {

            $table->integer('sinv_id')->unsigned();
            $table->integer('ipayment_id')->unsigned();
            $table->timestamps();

            $table->foreign('sinv_id')->references('id')->on('sinv');
            $table->foreign('ipayment_id')->references('id')->on('payemnts');

            $table->timestamps();
        });

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
        Schema::drop('vendors');
        Schema::drop('clients');
        Schema::drop('items');
        Schema::drop('opayments');
        Schema::drop('ipayments');
        Schema::drop('igroups');
        Schema::drop('clients');
        Schema::drop('pinv');
        Schema::drop('opayments2pinv');
        Schema::drop('ptransactions');
        Schema::drop('sinv');
        Schema::drop('ipayments2sinv');
        Schema::drop('stransactions');



    }
}
