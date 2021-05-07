<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

class Transaction extends Model
{
    use HasFactory;

    public $table = "transactions";

    protected $fillable = [
        'user_id', 'transaction_id', 'address', 'provinsi', 'kota', 'ekspedisi', 'kode_pos', 'total_berat', 'packet_status', 'resi_code', 'total', 'pay_status', 'method_paying_id', 'end_pay'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'products');
    }

    public function productTransaction()
    {
        return $this->belongsToMany(ProductTransaction::class, 'product_transaction');
    }

    public function product_transaction()
    {
        return $this->hasMany(ProductTransaction::class, 'transaction_id', 'id');
    }

    public function order_image()
    {
        return $this->hasMany(OrderImage::class, 'id', 'transaction_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->productTransaction()->detach();
        });
    }
}
