<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diversity extends Model
{
    //
    public function followers(){
        return $this->belongsToMany(Client::class);
    }
    public function connected(){
        return $this->belongsToMany(Item::class);
    }
}
