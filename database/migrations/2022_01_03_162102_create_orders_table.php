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
            $table->id('order_id');
            $table->foreignId('payment_id')->references('payment_id')->on('payments')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('order_status_id')->references('order_status_id')->on('order_statuses')->cascadeOnDelete();
            $table->string('id');
            $table->double('total');
            $table->double('subtotal');
            $table->double('delivery_fee');
            $table->string('name');
            $table->string('mobile');
            $table->string('division');
            $table->text('address');
            $table->boolean('inside_dhaka_city')->default(0);
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
