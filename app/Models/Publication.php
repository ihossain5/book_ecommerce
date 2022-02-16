<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $primaryKey = 'publication_id';

    protected $fillable = ['name','photo','description','precedance'];

    public function books(){
        return $this->hasMany(Book::class, 'publication_id');
    }
}
