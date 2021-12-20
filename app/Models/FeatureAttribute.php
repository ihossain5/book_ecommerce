<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureAttribute extends Model
{
    use HasFactory;

    protected $primaryKey = 'feature_attribute_id';

    protected $fillable = ['name'];
}
