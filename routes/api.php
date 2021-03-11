<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function (){
    Route::get('/test', function () {
        return response()->json(['test'=>'ok']);
    });

    Route::get('/products/{id?}', [ProductController::class,'index'])->name('product.list');
    Route::post('/products', [ProductController::class,'create'])->name('product.create');
    Route::put('/products', [ProductController::class,'update'])->name('product.update');
    Route::delete('/products', [ProductController::class,'destroy'])->name('product.delete');
});
