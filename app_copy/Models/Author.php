<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model {
    use HasFactory;

    protected $primaryKey = 'author_id';

    protected $fillable = ['name', 'photo', 'description'];

    //books relation
    public function books() {
        return $this->belongsToMany(Book::class, 'book_authors', 'author_id','book_id')->withTimestamps()->with('authors');
    }
}
