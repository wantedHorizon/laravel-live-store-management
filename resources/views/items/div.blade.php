@extends('layouts.app')

@section('content')
    <div class="wrapper item-detail">
        <h1>Diversities Manager</h1>
        <h2>Item name: {{$item->name}}</h2>
        <p class="catalog_number">{{$item->catalog_name}}</p>
        <p class="price">price: {{$item->price}}</p>
        <p class="catalog_number">enable: {{$item->enable}}</p>
        <form action="{{route('items.destroy',$item->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button >Remove Item</button>
        </form>
        <label class="titlex">Connected Diversities:</label>
        @foreach($divs as $d)

        <form action="/item/{{$item->id}}/{{$d->id}}" method="POST">
            @csrf
        <fieldset>

                <div>
                    <input
                        class="test1"
                        type="checkbox"
                        name="id2"
                        value="{{$d->id}}"
                        onclick="submit()"
                        @if($d->active ) checked @endif


                    > {{$d->name}}
                    <br />

                </div>
        </fieldset>
        </form>

        @endforeach


    </div>
    <a href="/items" class="back"> <- Back to all Clients</a>




@endsection


