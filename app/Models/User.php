<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass) {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function wishlists(){
        return $this->hasMany(Whislist::class)->with('book','book.reviews');
    }

    public function addresses() {
        return $this->belongsToMany(Address::class, 'user_addresses', 'user_id', 'address_id')
        ->withPivot('is_default')
        ->withTimestamps();
    }
}
