<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Carts extends Model
{
    use HasFactory;

    public $table = "carts";

    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'information'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'id','product_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id','user_id');
    }
}
