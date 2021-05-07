<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayingMethod extends Model
{
    use HasFactory;

    public $table = "methods_paying";

    protected $fillable = [
        'payingName', 'payingNumber'
    ];
}
