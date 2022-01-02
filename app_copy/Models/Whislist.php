<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whislist extends Model
{
    use HasFactory;

    protected $primaryKey = 'whislist_id';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
}
