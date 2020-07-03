<?php

namespace App\Http\Controllers;
use App\Diversity;
use App\Item;
use Illuminate\Http\Request;
use function Sodium\add;

class ItemController extends Controller
{
    //
    public function index(){
//        $arr = Items::all();
        $arr =Item::orderBy('name')->get();
        $name = request('name');
        return view('items.index', ['name'=>$name,'arr' => $arr]);
    }

    public function show($id){
        //$catalog_number=$id;
        $item = Item::findOrFail( $id);
        return view('items.show', ['item' => $item]);

    }
    public function div($id){
        //$catalog_number=$id;
        $item = Item::findOrFail( $id);
        $divs = Diversity::select('id','name')->get();

        for($i=0;$i<count($divs);$i++){

            if($item->following->contains($divs[$i]))
            {

                $divs[$i]->setAttribute('active',true);
            } else{
                $divs[$i]->setAttribute('active',false);
            }
        }


        return view('items.div', ['item' => $item, 'divs'=>$divs]);

    }
    public function div2($id, $id2){
        $item = Item::findOrFail( $id);
        $item->following()->toggle($id2);

        return redirect()->route('item.div', [$id]);
    }

    public function create(){
       return view('items.create');

    }
    public function store() {

        $item = new Item();
        $item->name = request('name');
        $item->price = request('price');
        $item->enable = request('enable');
        $item->has_vat = 1;
        $item->catalog_number = request('catalog_number');

        $item->save();

        return redirect('/')->with('msg','Item added');
    }

    public function destroy($id){
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect('/')->with('msg','Item deleted');
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = Item::orderBy('id','desc')->get();
            echo json_encode($data);
        }
    }

    function add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                'name'    =>  $request->name,
                'catalog_number'    =>  $request->catalog_number,
                'enable'     =>  $request->enable,
                'has_vat' => $request->has_vat,
                'price' => $request->price
            );
            $id = Item::insert($data);
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
            Item::
            where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
            Item::
            where('id', $request->id)
                ->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }
}
