<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'ingredients', // Assuming ingredients is a JSON field
    ];

    protected $casts = [
        'ingredients' => 'array',
    ];

    // public function components()
    // {
    //     return $this->belongsToMany(Component::class, 'food_component');
    // }

    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class, 'order_items');
    // }
}
