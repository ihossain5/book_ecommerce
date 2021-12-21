<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->foreignId('publication_id')->references('publication_id')->on('publications')->cascadeOnDelete();
            $table->string('title');
            $table->string('isbn');
            $table->string('cover_image');
            $table->string('backside_image');
            $table->string('book_preview');
            $table->string('short_description');
            $table->text('long_description');
            $table->double('regular_price');
            $table->double('discounted_price');
            $table->double('discounted_percentage');
            $table->boolean('is_available')->default(1);
            $table->boolean('is_visible')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('books');
    }
}
