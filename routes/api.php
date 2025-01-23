<?php

use App\Http\Controllers\SpiderController;
use Illuminate\Support\Facades\Route;


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// dd(url()->current());
Route::get('/scraping/tolidat/{page}', [SpiderController::class, 'tolidatScraping']);
Route::post('/search/', 'InventoryController@search')->name('inventory.search');
Route::get('spider','SpiderController@spider');
Route::get('/spider/reload', 'SpiderController@reload');
Route::post('/spider/addToCms', 'SpiderController@addToCms');
