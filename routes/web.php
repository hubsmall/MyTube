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

Auth::routes();

Route::redirect('/', 'home', 301);

Route::get('chanels/{id}/playlists','PlaylistController@index');
Route::get('chanels/{id}/playlists/{id2}/videos','VideoController@index');
Route::get('chanels/{id}/playlists/{id2}/videos/{id3}','VideoController@show');
Route::get('chanels/{id}/videos/{id2}','ChanelController@show');
Route::get('admin/{id}','AdminChanelController@show');
Route::post('admin/updatechanel', 'AdminChanelController@updatechanel');
Route::post('admin/destroy', 'AdminChanelController@destroy');

//Route::resource('chanels.playlists', 'PlaylistController');
Route::resource('chanels.playlists.videos', 'VideoController');
Route::resource('chanels.videos', 'ChanelController');

Route::get('admin.search', 'AdminChanelController@search');
Route::get('admin.transaction', 'AdminChanelController@transaction');

Route::apiResources([
    'home' => 'HomeController',
    'admin' => 'AdminChanelController',
]);
