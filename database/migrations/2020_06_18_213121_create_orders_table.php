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
            $table->string('receiver_name');
            $table->string('receiver_last_name');
            $table->string('receiver_tel');
            $table->string('state');
            $table->string('city');
            $table->string('street_name');
            $table->string('street_number');
            $table->integer('quantity');
            $table->integer('weight');
            $table->string('order_type');
            $table->boolean('is_openable');
            $table->boolean('is_returnable');
            $table->string('additional_notes');
            $table->string('order_name');
            $table->string('description');
            $table->float('price');
            $table->string('status');
            $table->foreignId('seller_id')->constrained('users', 'id');
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
