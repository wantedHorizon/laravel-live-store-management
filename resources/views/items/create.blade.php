
@extends('layouts.app')

@section('content')
    <div class="wrapper create-item">
        <h1>Add a new Item</h1>
        <form action="/items" method="POST">
            @csrf
            <label for="name">Item name:</label>
            <input type="text" id="name" name="name" />

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" />

            <label for="catalog_number">Catalog_Number:</label>
            <input type="number" id="catalog_number" name="catalog_number" />

            <label for="enable">Enable</label>
            <select name="enable" id="enable">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
            <input type="submit" value="create Item">
        </form>
    </div>
@endsection
