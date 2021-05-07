<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayingMethod extends Model
{
    use HasFactory;

    public $table = "methods_paying";

    protected $fillable = [
        'payingName', 'payingNumber', 'name'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id', 'method_paying_id');
    }
}
