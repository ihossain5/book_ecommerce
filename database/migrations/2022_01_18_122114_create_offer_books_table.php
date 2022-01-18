<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_books', function (Blueprint $table) {
            $table->id('offer_book_id');
            $table->foreignId('offer_id')->references('offer_id')->on('offers')->cascadeOnDelete();
            $table->foreignId('book_id')->references('book_id')->on('books')->cascadeOnDelete();
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
        Schema::dropIfExists('offer_books');
    }
}
