<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//change this
use App\Http\Controllers\Api\RegisterApiController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Register Api
Route::post('register',[RegisterApiController::class,'register']);

//Login Api
Route::post('login',[RegisterApiController::class,'login']);

//Data View Api
Route::post('media-list',[RegisterApiController::class,'mediaview']);











