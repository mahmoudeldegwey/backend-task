<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MenuItemController,ProblemSolvingController,OrderController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test',function() {
    //return date('hms');
    //return App\Models\Order::with('items')->get();
    //return generate_order_number();
    //return $data = json_decode(json_encode());

    //return array_values((array));
});


Route::post('lowest-integer-positive','ProblemSolvingController@lowestIntegerPositive');
Route::get('count-numbers','ProblemSolvingController@countNumbers');

//menu items
Route::apiResource('menu-items',MenuItemController::class);

//orders
Route::apiResource('orders',OrderController::class);