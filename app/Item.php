<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $casts = [
        'toppings' => 'array',
    ];
    public function following(){
        return $this->belongsToMany(Diversity::class);
    }

}
