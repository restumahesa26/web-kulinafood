<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public $table = "product_image";

    protected $fillable = [
        'product_id', 'product_image_id'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id', 'id');
    }
}
