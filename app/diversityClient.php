<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diversityClient extends Model
{
    //

    public function show($id){
        //$catalog_number=$id;
        $item = Item::findOrFail( $id);
        return view('items.show', ['item' => $item]);

    }
}
