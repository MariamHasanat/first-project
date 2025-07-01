<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_component');
    }
}
