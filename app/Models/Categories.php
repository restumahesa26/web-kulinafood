<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public $table = "categories";

    protected $fillable = [
        'name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id','category_id');
    }
}
