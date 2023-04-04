<?php

use App\Http\Controllers\API\RouteController;
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

//api with GET
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']); //READ *
Route::get('pizza/system/data',[RouteController::class,'allData']); // READ
Route::get('category/details/{id}',[RouteController::class,'categoryDetails']); //READ

//api with POST
Route::post('create/category',[RouteController::class,'categoryCreate']); // CREATE
Route::post('create/contact',[RouteController::class,'contactCreate']); // CREATE
Route::post('category/delete',[RouteController::class,'categoryDelete']); // DELETE
Route::post('category/update',[RouteController::class,'categoryUpdate']); // UPDATE

/**
 * product list
 * localhost:8000/api/product/list (GET)
 *
 * category list
 * localhost:8000/api/category/list (GET)
 *
 * create category
 * localhost:8000/api/create/catgory (POST)
 * body{
 *  name : ''
 * }
 *
 * localhost:8000/api/category/delete/{id} (GET)
 *
 * localhost:8000/api/category/list/{id} (GET)
 *
 * localhost:8000/api/category/update (POST)
 *
 * key => category_id, category_name
 */
