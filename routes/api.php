<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login',[ApiController::class,'login']);
Route::post('register',[ApiController::class,'register']);

Route::middleware(['auth:api'])->group(function () {

    Route::get('/', [ApiController::class,'index']);
    Route::get('email/{email}',[ApiController::class,'email']);
    Route::post('/add', [ApiController::class,'add']);
    Route::delete('id/{id}',[ApiController::class,'delete']);

});
