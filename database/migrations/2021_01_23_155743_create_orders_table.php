<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('car_type');
            $table->string('car_model');
            $table->string('in_color');
            $table->string('out_color');
            $table->string('double_thread_color');
            $table->enum('design_type',['normal','threeD'])->default('normal');
            $table->date('recieved_date');
            $table->longText('special_request')->nullable();
            $table->string('chaire_image')->nullable();
            $table->string('sofa_image')->nullable();
            $table->enum('bill_type',['gomla','part'])->default('part');
            $table->bigInteger('cust_id')->unsigned()->nullable();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('restrict');

            $table->enum('status',['sent','recieved','done'])->default('sent');




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
        Schema::dropIfExists('orders');
    }
}
