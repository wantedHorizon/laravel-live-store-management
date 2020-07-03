<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    public function following(){
        return $this->belongsToMany(Diversity::class);
    }
}
