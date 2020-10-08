<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [
        'name', 'description', 'type_id', 'manufacturer_id'
    ];
    protected $table = 'beer';

    public function manufacturers()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }
    public function types()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
