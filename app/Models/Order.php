<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $guarded = [];

    public function setDeliveryFeeAttribute($deliveryFee) {
        $this->attributes['delivery_fee'] = floatval(preg_replace('/[^\d.]/', '', $deliveryFee));
    }

    public function setTotalAttribute($total) {
        $this->attributes['total'] = floatval(preg_replace('/[^\d.]/', '', $total));
    }

    public function setSubTotalAttribute($subTotal) {
        $this->attributes['subtotal'] = floatval(preg_replace('/[^\d.]/', '', $subTotal));
    }

    public function books() {
        return $this->belongsToMany(Book::class, 'order_books', 'order_id', 'book_id')->withPivot('quantity', 'amount')->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function paymentMethod() {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
