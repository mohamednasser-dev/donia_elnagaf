<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cust_id')->unsigned()->nullable();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('restrict');

            $table->string('bill_num')->nullable();
            $table->float('total')->default('0');
            $table->float('pay')->default('0');
            $table->float('remain')->default('0');
            $table->float('total_profit')->default('0');
            $table->date('date');
            $table->string('notes')->nullable();
            $table->enum('type',['buy','back','part'])->default('buy');
            $table->enum('is_bill',['y','n'])->default('y');
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
        Schema::dropIfExists('customer_bills');
    }
}
