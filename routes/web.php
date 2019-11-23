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

Route::get("/customers", "CustomerController@index")->name("customers");
Route::get("/customers/create", "CustomerController@create")->name("customers:create");
Route::post("/customers", "CustomerController@store");
Route::get("/customers/{id}/edit", "CustomerController@edit")->where("id", "[0-9]+")->name("customers:edit");
Route::get("/customers/{id}/disable", "CustomerController@disablePage")->where("id", "[0-9]+")->name("customers:disable");
Route::get("/customers/{id}/active", "CustomerController@activePage")->where("id", "[0-9]+")->name("customers:active");
Route::put("/customers", "CustomerController@update");
Route::post("/customers/disable", "CustomerController@disable")->name("customers:disable@presist");
Route::post("/customers/active", "CustomerController@active")->name("customers:active@presist");
Route::get("/customers/all", "CustomerController@all")->name("customers:all");
Route::get("/logout", "UserController@logout")->name("logout");