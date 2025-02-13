<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'description',
        'price',
        'tags',
        'detail_image',
        'detail_image_1',
        'detail_image_2',
        'detail_image_3',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
