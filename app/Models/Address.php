<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'address_id';

    protected $guarded = [];

    public function user_address() {
        return $this->belongsToMany(User::class,'user_addresses','address_id','user_id')->withPivot('is_default');
    }
}
