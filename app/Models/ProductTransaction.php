<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    public $table = "product_transaction";

    protected $fillable = [
        'transaction_id', 'product_transaction_id', 'quantity'
    ];

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_transaction_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'product_transaction_id', 'id');
    }
}
