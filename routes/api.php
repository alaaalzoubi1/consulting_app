<?php

use App\Http\Controllers\ExpertController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post("register" , [UserController::class,"register"]);
Route::post("login" , [UserController::class , "login"]);
Route::group(["middleware" => ["auth:sanctum"]] , function (){
    Route::get("logout" , [UserController::class , "logout"]);
});
Route::post("expertDetails",[ExpertController::class,"expertDetails"]);
Route::post('find/{id}',[FavouriteController::class,'getFav']);
Route::post('makeFavouriteList',[FavouriteController::class,'makeFavouriteList']);
Route::post("getname",[ExpertController::class,"getName"]);
Route::post("conGet",[ExpertController::class,"conGet"]);
Route::post("search",[ExpertController::class,"search"]);
Route::post("getExperts/{con}",[UserController::class,"getExperts"]);
Route::post("userReserv",[reservationController::class,"userReserv"]);
Route::post("getAvailableReservation/{id}",[reservationController::class,"getAvailableReservation"]);
Route::post("myReservation/{id}",[reservationController::class,"myReservation"]);
