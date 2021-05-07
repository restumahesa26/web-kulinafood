<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $table = "ratings";

    protected $fillable = [
        'product_transaction_id', 'rating', 'ratingDescription'
    ];

    public function product_transaction()
    {
        return $this->belongsToMany(ProductTransaction::class, 'product_transaction_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
