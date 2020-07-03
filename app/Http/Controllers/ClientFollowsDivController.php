<?php

namespace App\Http\Controllers;

use App\Diversity;
use Illuminate\Http\Request;
use App\Client;
class ClientFollowsDivController extends Controller
{
    //
    public function store(Client $client, Diversity $diversity){
        return $client->following()->toggle($client);
    }

}
