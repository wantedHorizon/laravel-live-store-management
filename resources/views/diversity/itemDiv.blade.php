@extends('layouts.app')

@section('content')
    <div class="wrapper item-detail">



        <label class="titlex">Connected Items:</label>
        <h2>Diversity name: {{$div->name}}</h2>
        @foreach($items as $item)

            <form action="/diversities/item/{{$div->id}}/{{$item->id}}" method="POST">
                @csrf
                <fieldset>

                    <div>
                        <input
                            class="test1"
                            type="checkbox"
                            name="id2"
                            value="{{$item->id}}"
                            onclick="submit()"
                            @if($item->active ) checked @endif


                        > {{$item->name}}
                        <br />

                    </div>
                </fieldset>
            </form>

        @endforeach


    </div>
    <a href="/items" class="back"> <- Back to all Diversities</a>




@endsection


