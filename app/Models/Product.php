<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carts;

class Product extends Model
{
    use HasFactory;

    public $table = "products";

    protected $fillable = [
        'productName', 'category_id', 'price', 'productDescription', 'stock', 'weight', 'img_url', 'best_seller', 'new'
    ];

    public function categories()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Carts::class, 'product_id', 'id');
    }

    public function product_transaction()
    {
        return $this->belongsToMany(ProductTransaction::class, 'product_transaction_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'transactions');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productImage()
    {
        return $this->belongsToMany(ProductImage::class, 'product_image');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'id', 'produk_id');
    }
}
