<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model {
    use HasFactory;

    protected $primaryKey = 'book_review_id';

    protected $guarded = [];

    //user relation
    public function user() {
        return $this->belongsTo(User::class);
    }
}
