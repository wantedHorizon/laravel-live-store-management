<?php

namespace App\Http\Controllers;

use App\Client;
use App\Item;
use Illuminate\Http\Request;
use App\Diversity;

class DiversityController extends Controller
{
    //

    function index()
    {
        return view('diversity');
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = Diversity::orderBy('id','desc')->get();
            echo json_encode($data);
        }
    }

    function add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                'name'    =>  $request->name,
                'enable'     =>  $request->enable
            );
            $id = Diversity::insert($data);
            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Inserted</div>';
            }
        }
    }

    function update_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name       =>  $request->column_value
            );
            Diversity::
            where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
            Diversity::
            where('id', $request->id)
                ->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }

    public function div_client($id){
        //$catalog_number=$id;
        $div = Diversity::findOrFail( $id);
        $clients = Client::select('id','name')->get();

        for($i=0;$i<count($clients);$i++){

            if($div->followers->contains($clients[$i]))
            {

                $clients[$i]->setAttribute('active',true);
            } else{
                $clients[$i]->setAttribute('active',false);
            }
        }


        return view('diversity.clientDiv', ['div' => $div, 'clients'=>$clients]);

    }
    public function div2_client($id, $id2){
        $div = Diversity::findOrFail( $id);
        $div->followers()->toggle($id2);

        return redirect()->route('diversities.client.div', [$id]);
    }

    public function div_item($id){
        //$catalog_number=$id;
        $div = Diversity::findOrFail( $id);
        $items = Item::select('id','name')->get();

        for($i=0;$i<count($items);$i++){

            if($div->connected->contains($items[$i]))
            {

                $items[$i]->setAttribute('active',true);
            } else{
                $items[$i]->setAttribute('active',false);
            }
        }


        return view('diversity.itemDiv', ['div' => $div, 'items'=>$items]);

    }
    public function div2_item($id, $id2){
        $div = Diversity::findOrFail( $id);
        $div->connected()->toggle($id2);

        return redirect()->route('diversities.item.div', [$id]);
    }
}
