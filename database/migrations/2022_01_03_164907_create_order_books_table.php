<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBooksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('order_books', function (Blueprint $table) {
            $table->id('order_book_id');
            $table->foreignId('order_id')->references('order_id')->on('orders')->cascadeOnDelete();
            $table->foreignId('book_id')->references('book_id')->on('books')->cascadeOnDelete();
            $table->integer('quantity');
            $table->double('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('order_books');
    }
}
