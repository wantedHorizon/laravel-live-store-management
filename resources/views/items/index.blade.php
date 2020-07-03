
@extends('layouts.app')

@section('content')

<div class="container box">
    <div class="titlex    col-6 ">
        Items Live Table

    </div>
    <br>    <div class="panel panel-default">

        <div class="panel-body">
            <div id="message"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Catalog Number</th>
                        <th>Name</th>
                        <th>Has_vat</th>
                        <th>Enable</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        fetch_data();

        function fetch_data() {
            $.ajax({
                url: "/items/fetch_data",
                dataType: "json",
                success: function (data) {
                    var html = '';
                    html += '<tr>';
                    html += '<td contenteditable id="catalog_number"></td>';
                    html += '<td contenteditable id="name"></td>';
                    html += '<td contenteditable id="has_vat"></td>';
                    html += '<td contenteditable id="enable"></td>';
                    html += '<td contenteditable id="price"></td>';
                    html += '<td><button type="button" class="btn btn-success mx-2" id="add">Add</button></td></tr>';
                    for (var count = 0; count < data.length; count++) {
                        html += '<tr>';
                        html += '<td contenteditable class="column_name" data-column_name="catalog_number" data-id="' + data[count].id + '">' + data[count].catalog_number + '</td>';
                        html += '<td contenteditable class="column_name" data-column_name="name" data-id="' + data[count].id + '">' + data[count].name + '</td>';
                        html += '<td contenteditable class="column_name" data-column_name="has_vat" data-id="' + data[count].id + '">' + data[count].has_vat + '</td>';
                        html += '<td contenteditable class="column_name" data-column_name="enable" data-id="' + data[count].id + '">' + data[count].enable + '</td>';
                        html += '<td contenteditable class="column_name" data-column_name="price" data-id="' + data[count].id + '">' + data[count].price + '</td>';
                        html += '<td><button type="button" class="btn btn-danger mx-2 delete" id="' + data[count].id + '">Delete</button>';
                        html += `<a href="/item/${data[count].id}/div"><button type="button" class="btn btn-warning mx-2 " id=" ${data[count].id}">Edit diviersities</button></a>`;
                        html += '</td></tr>';
                    }
                    $('tbody').html(html);
                }
            });
        }

        var _token = $('input[name="_token"]').val();

        $(document).on('click', '#add', function () {
            let name = $('#name').text();
            let catalog_number = $('#catalog_number').text();
            let has_vat = $('#has_vat').text();
            let enable = $('#enable').text();
            let price = $('#price').text();

            if (name != '' && catalog_number!= ''  && (enable == '0' || enable == '1')) {
                $.ajax({
                    url: "{{ route('items.add_data') }}",
                    method: "POST",
                    data: {name: name, catalog_number: catalog_number, enable: enable,has_vat:has_vat,price:price, _token: _token},
                    success: function (data) {
                        $('#message').html(data);
                        fetch_data();
                    }
                });
            } else {
                $('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
            }
        });

        $(document).on('blur', '.column_name', function () {
            var column_name = $(this).data("column_name");
            var column_value = $(this).text();
            var id = $(this).data("id");

            if (column_value != '') {
                $.ajax({
                    url: "{{ route('items.update_data') }}",
                    method: "POST",
                    data: {column_name: column_name, column_value: column_value, id: id, _token: _token},
                    success: function (data) {
                        $('#message').html(data);
                    }
                })
            } else {
                $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
            }
        });

        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this records?")) {
                $.ajax({
                    url: "{{ route('items.delete_data') }}",
                    method: "POST",
                    data: {id: id, _token: _token},
                    success: function (data) {
                        $('#message').html(data);
                        fetch_data();
                    }
                });
            }
        });


    });
</script>


@endsection
