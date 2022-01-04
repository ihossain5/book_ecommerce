<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_book_id';

    public function setAmountAttribute($amount) {
        $this->attributes['amount'] = floatval(preg_replace('/[^\d.]/', '', $amount));
    }

    public function setQuantityAttribute($quantity) {
        $this->attributes['quantity'] = floatval(preg_replace('/[^\d.]/', '', $quantity));
    }
}
