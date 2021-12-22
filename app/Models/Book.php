<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;

    protected $primaryKey = 'book_id';

    protected $guarded = [];

    //categories relation
    public function categories() {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id', 'category_id')->withTimestamps();
    }

    //authors relation
    public function authors() {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id')->withTimestamps();
    }

    //publication relation
    public function publication() {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    //feature attribute relation
    public function featureAttributes() {
        return $this->belongsToMany(FeatureAttribute::class, 'book_feature_attributes', 'book_id', 'feature_attribute_id')
        ->withPivot( 'value')
        ->withTimestamps();
    }
}
