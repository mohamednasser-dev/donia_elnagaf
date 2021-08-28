<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->float('money');
            $table->string('notes')->nullable();
            $table->bigInteger('bill_id')->unsigned()->nullable();
            $table->foreign('bill_id')->references('id')->on('customer_bills')->onDelete('restrict');
            $table->bigInteger('cust_id')->unsigned()->nullable();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('restrict');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('customer_payments');
    }
}
