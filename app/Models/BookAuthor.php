<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_author_id';

    protected $guarded = [];

    public function books() {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
