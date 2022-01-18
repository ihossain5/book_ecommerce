<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $primaryKey = 'offer_id';

    protected $fillable = ['title','is_visible'];

     //books relation
     public function books() {
        return $this->belongsToMany(Book::class, 'offer_books','offer_id','book_id')->withTimestamps();
    }

}
