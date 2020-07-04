<?php

namespace App\Http\Controllers;

use App\Diversity;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
//        $arr = Items::all();

        return view('clients');
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = Client::orderBy('id','desc')->get();
            echo json_encode($data);
        }
    }

    function add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                'name'    =>  $request->name,
                'enable'     =>  $request->enable,
                'type' => $request->type
            );
            $id = Client::insert($data);
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
            Client::
            where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
            Client::
            where('id', $request->id)
                ->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }

    public function div($id){
        //$catalog_number=$id;
        $item = Client::findOrFail( $id);
        $divs = Diversity::select('id','name')->get();

        for($i=0;$i<count($divs);$i++){

            if($item->following->contains($divs[$i]))
            {

                $divs[$i]->setAttribute('active',true);
            } else{
                $divs[$i]->setAttribute('active',false);
            }
        }


        return view('clients.div', ['client' => $item, 'divs'=>$divs]);

    }
    public function div2($id, $id2){
        $item = Client::findOrFail( $id);
        $item->following()->toggle($id2);

        return redirect()->route('clients.div', [$id]);
    }


}
