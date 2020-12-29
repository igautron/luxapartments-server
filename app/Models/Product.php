<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'images',
        'title',
        'city',
        'area',
        'meters',
        'terrace',
        'category',
        'descr',
        'price',
        'stage',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::retrieved(function ($user) {
            $user->images = array_map(function($el)
            {
                return asset('storage/images/'.$el);
            }, explode('|', $user->images));
        });
    }
}