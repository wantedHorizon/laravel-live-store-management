
@extends('layouts.layout')

@section('content')
  <div class="wrapper item-detail">
      <h1>Item name: {{$item->name}}</h1>
      <p class="catalog_number">{{$item->catalog_name}}</p>
      <p class="price">price: {{$item->price}}</p>
      <p class="catalog_number">enable: {{$item->enable}}</p>
      <form action="{{route('items.destroy',$item->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button >Remove Item</button>
      </form>
  </div>
  <a href="/items" class="back"> <- Back to all items</a>

@endsection
