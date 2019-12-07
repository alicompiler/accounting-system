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

Route::get("/customers", "CustomerController@index")->name("customers")->middleware("auth");
Route::get("/customers/create", "CustomerController@create")->name("customers:create")->middleware("auth");
Route::post("/customers", "CustomerController@store")->middleware("auth");
Route::get("/customers/{id}/edit", "CustomerController@edit")->where("id", "[0-9]+")->name("customers:edit")->middleware("auth");
Route::get("/customers/{id}/disable", "CustomerController@disablePage")->where("id",
    "[0-9]+")->name("customers:disable")->middleware("auth");
Route::get("/customers/{id}/active", "CustomerController@activePage")->where("id", "[0-9]+")->name("customers:active")->middleware("auth");
Route::put("/customers", "CustomerController@update")->middleware("auth");
Route::post("/customers/disable", "CustomerController@disable")->name("customers:disable@presist")->middleware("auth");
Route::post("/customers/active", "CustomerController@active")->name("customers:active@presist")->middleware("auth");
Route::get("/customers/all", "CustomerController@all")->name("customers:all")->middleware("auth");


Route::get("/categories", "CategoryController@index")->name("categories")->middleware("auth");
Route::get("/categories/{id}/edit", "CategoryController@edit")->name("categories:edit")->middleware("auth");
Route::post("/categories", "CategoryController@store")->middleware("auth");
Route::post("/categories/active", "CategoryController@active")->name("categories:active")->middleware("auth");
Route::post("/categories/disable", "CategoryController@disable")->name("categories:disable")->middleware("auth");
Route::put("/categories", "CategoryController@update")->middleware("auth");


Route::get("/actions/{id}", "ActionController@single")->where("id", "[0-9]+")->name("actions:single")->middleware("auth");
Route::get("/actions/create", "ActionController@create")->name("actions:create")->middleware("auth");
Route::get("/actions/{id}/edit", "ActionController@edit")->name("actions:edit")->middleware("auth");
Route::post("/actions", "ActionController@store")->name("actions:create@presist")->middleware("auth");
Route::put("/actions", "ActionController@update")->name("actions:edit@presist")->middleware("auth");


Route::get("/report/customer", "ReportController@customerReport")->name("report:customer")->middleware("auth");
Route::get("/report/action", "ReportController@actionReport")->name("report:action")->middleware("auth");
Route::get("/report/all-customers", "ReportController@allCustomersReport")->name("report:all-customers")->middleware("auth");


Route::view("/login", "main.login")->name("login-page");
Route::post("/login", "LoginController@login")->name('login');
Route::any("/logout", "LoginController@logout")->name('logout');

Route::view("/", "main.main")->name("home")->middleware("auth");


Route::get("/print/action", "ReportController@printActionsReport")->name("print:action")->middleware("auth");
Route::get("/print/customer", "ReportController@printCustomersReport")->name("print:customer")->middleware("auth");
Route::get("/print/action/{id}", "ReportController@printSingleActionReport")->name("print:single-action")->middleware("auth");