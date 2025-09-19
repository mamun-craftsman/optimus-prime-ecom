<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key_feature_left',
        'key_feature_right',
        'price',
        'description',
        'primary_image',
        'secondary_images',
        'video_url',
        'stock',
        'status'
    ];

    protected $casts = [
        'secondary_images' => 'array',
        'price' => 'decimal:2'
    ];
}
