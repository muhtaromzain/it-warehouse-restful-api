<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // use Authenticatable, Authorizable, HasFactory;
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'name', 
        'price',
        'colour',
        'condition',
        'description',
    ];

}
