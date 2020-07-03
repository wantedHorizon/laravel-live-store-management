
@extends('layouts.app')

@section('content')
<div class="flex-top  position-ref full-height">



        <div class="wrapper  item-index">
            <h1>Items</h1>
            @foreach($arr as $ele)
                <div>
                    <a href="/items/{{$ele->id}}">{{$ele->name}}</a>
                </div>
            @endforeach
        </div>

</div>

@endsection
