<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;
    protected $primaryKey = 'category_id';

    protected $fillable = ['name', 'description', 'is_home', 'is_nav', 'photo', 'precedance'];

    //books relation
    public function books() {
        return $this->belongsToMany(Book::class, 'book_categories', 'category_id', 'book_id')->withTimestamps();
    }
}
