<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookFeatureAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_feature_attributes', function (Blueprint $table) {
            $table->id('book_feature_attribute_id');
            $table->foreignId('feature_attribute_id')->references('feature_attribute_id')->on('feature_attributes')->cascadeOnDelete();
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
        Schema::dropIfExists('book_feature_attributes');
    }
}
