@extends('layouts.app')

@section('content')
    <div class="wrapper item-detail">



        <label class="titlex">Connected Diversities:</label>
        <h2>Client name: {{$client->name}}</h2>
        @foreach($divs as $d)

            <form action="/client/{{$client->id}}/{{$d->id}}" method="POST">
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
    <a href="/items" class="back"> <- Back to all items</a>




@endsection


