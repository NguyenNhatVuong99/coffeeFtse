<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_id')->nullable();
            $table->dateTime('date');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type_documents')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('table_id')->unsigned()->nullable();
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('content')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('total_quantity')->nullable();
            $table->integer('price')->nullable();
            $table->integer('reduce')->nullable();
            $table->integer('total_price')->nullable();
            $table->dateTime('time_in');
            $table->dateTime('time_out')->nullable();
            $table->integer('prepay')->nullable();
            $table->integer('debt')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('documents');
    }
}
