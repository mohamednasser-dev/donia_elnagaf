<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierBillBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_bill_bases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('quantity');
            $table->float('purchas_price');
            $table->float('total');
            $table->date('date');
            $table->bigInteger('supplier_sale_id')->unsigned()->nullable();
            $table->foreign('supplier_sale_id')->references('id')->on('supplier_sales')->onDelete('restrict');
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');
            $table->bigInteger('base_id')->unsigned()->nullable();
            $table->foreign('base_id')->references('id')->on('bases')->onDelete('restrict');
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
        Schema::dropIfExists('supplier_bill_bases');
    }
}
