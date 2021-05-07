<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class Address extends Model
{
    use HasFactory;

    public $table = "address";

    protected $fillable = [
        'user_id', 'provinsi', 'kabupaten', 'kecamatan', 'desa'
    ];

    public function provinsi() 
    {
        return $this->hasOne(Province::class, 'id','provinsi');
    }

    public function kabupaten() 
    {
        return $this->hasOne(City::class, 'id','kabupaten');
    }

    public function district() 
    {
        return $this->hasOne(District::class, 'id','kecamatan');
    }

    public function village() 
    {
        return $this->hasOne(Village::class, 'id','desa');
    }
}
