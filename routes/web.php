<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//items
Route::get('/item/{id}/div', 'ItemController@div')->name('item.div');
Route::post('/item/{id}/{id2}', 'ItemController@div2')->name('item.div2');
Route::get('/items/fetch_data', 'ItemController@fetch_data');
Route::post('/items/add_data', 'ItemController@add_data')->name('items.add_data');
Route::post('/items/update_data', 'ItemController@update_data')->name('items.update_data');
Route::post('/items/delete_data', 'ItemController@delete_data')->name('items.delete_data');


Route::get('/items', 'ItemController@index')->name('items.index');
Route::get('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items', 'ItemController@store')->name('items.store');
Route::get('/items/{id}', 'ItemController@show')->name('items.show');
Route::delete('items/{id}', 'ItemController@destroy')->name('items.destroy');

//clients
//Route::get('/client', 'ClientController@index')->name('client.index')->middleware('auth');
//Route::get('/client/create', 'ClientController@create')->name('client.create')->middleware('auth');
//Route::post('/client', 'ClientController@store')->name('client.store')->middleware('auth');
//Route::get('/client/{id}', 'ClientController@show')->name('client.show')->middleware('auth');
//Route::delete('client/{id}', 'ClientController@destroy')->name('client.destroy')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');;


Route::get('/livetable', 'LiveTableController@index');
Route::get('/livetable/fetch_data', 'LiveTableController@fetch_data');
Route::post('/livetable/add_data', 'LiveTableController@add_data')->name('livetable.add_data');
Route::post('/livetable/update_data', 'LiveTableController@update_data')->name('livetable.update_data');
Route::post('/livetable/delete_data', 'LiveTableController@delete_data')->name('livetable.delete_data');


//client
Route::get('/client/{id}/div', 'ClientController@div')->name('clients.div');
Route::post('/client/{id}/{id2}', 'ClientController@div2')->name('clients.div2');

Route::get('/client', 'ClientController@index')->name('client.index');
Route::get('/client/fetch_data', 'ClientController@fetch_data');
Route::post('/client/add_data', 'ClientController@add_data')->name('client.add_data');
Route::post('/client/update_data', 'ClientController@update_data')->name('client.update_data');
Route::post('/client/delete_data', 'ClientController@delete_data')->name('client.delete_data');

//diversity
Route::get('/diversities/client/{id}/div', 'DiversityController@div_client')->name('diversities.client.div');
Route::post('/diversities/client/{id}/{id2}', 'DiversityController@div2_client')->name('diversities.client.div2');

Route::get('/diversities/item/{id}/div', 'DiversityController@div_item')->name('diversities.item.div');
Route::post('/diversities/item/{id}/{id2}', 'DiversityController@div2_item')->name('diversities.item.div2');

Route::get('/diversities', 'DiversityController@index')->name('diversities.index');
Route::get('/diversities/fetch_data', 'DiversityController@fetch_data');
Route::post('/diversities/add_data', 'DiversityController@add_data')->name('diversities.add_data');
Route::post('/diversities/update_data', 'DiversityController@update_data')->name('diversities.update_data');
Route::post('/diversities/delete_data', 'DiversityController@delete_data')->name('diversities.delete_data');
