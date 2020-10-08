<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name'
    ];
    public function beer()
    {
        return $this->hasMany(Beer::class, 'type_id', 'id');
    }
}
