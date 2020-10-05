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
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('total_quantity');
            $table->integer('sub_price');
            $table->integer('reduce_price')->default(0);
            $table->integer('total_price');
            $table->dateTime('time_in');
            $table->dateTime('time_out');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status')->default(0);
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
