<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountOffer extends Model
{
    use HasFactory;

    protected $primaryKey = 'discount_offer_id';

    protected $fillable = ['image','is_visible'];
}
