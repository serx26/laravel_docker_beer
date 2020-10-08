<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name', 'address',
    ];
    protected $table = 'manufacturers';
    public function beer()
    {
        return $this->hasMany(Beer::class, 'manufacturer_id', 'id');
    }
}
