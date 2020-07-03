@extends('layouts.app')

@section('content')
    <div class="wrapper item-detail">



        <label class="titlex">Connected Items:</label>
        <h2>Diversity name: {{$div->name}}</h2>
        @foreach($clients as $client)

            <form action="/diversities/client/{{$div->id}}/{{$client->id}}" method="POST">
                @csrf
                <fieldset>

                    <div>
                        <input
                            class="test1"
                            type="checkbox"
                            name="id2"
                            value="{{$client->id}}"
                            onclick="submit()"
                            @if($client->active ) checked @endif


                        > {{$client->name}}
                        <br />

                    </div>
                </fieldset>
            </form>

        @endforeach


    </div>
    <a href="/items" class="back"> <- Back to all Diversities</a>




@endsection


