<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ReportController;

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

Route::get("/customers", [CustomerController::class, 'index'])->name("customers")->middleware("auth");
Route::get("/customers/create", [CustomerController::class, 'create'])->name("customers:create")->middleware("auth");
Route::post("/customers", [CustomerController::class, 'store'])->middleware("auth");
Route::get("/customers/{id}/edit", [CustomerController::class, 'edit'])->where("id", "[0-9]+")->name("customers:edit")->middleware("auth");
Route::get("/customers/{id}/disable", [CustomerController::class, 'disablePage'])->where("id",
    "[0-9]+")->name("customers:disable")->middleware("auth");
Route::get("/customers/{id}/active", [CustomerController::class, 'activePage'])->where("id", "[0-9]+")->name("customers:active")->middleware("auth");
Route::put("/customers", [CustomerController::class, 'update'])->middleware("auth");
Route::post("/customers/disable", [CustomerController::class, 'disable'])->name("customers:disable@presist")->middleware("auth");
Route::post("/customers/active", [CustomerController::class, 'active'])->name("customers:active@presist")->middleware("auth");
Route::get("/customers/all", [CustomerController::class, 'all'])->name("customers:all")->middleware("auth");


Route::get("/categories", [CategoryController::class, 'index'])->name("categories")->middleware("auth");
Route::get("/categories/{id}/edit", [CategoryController::class, 'edit'])->name("categories:edit")->middleware("auth");
Route::post("/categories", [CategoryController::class, 'store'])->middleware("auth");
Route::post("/categories/active", [CategoryController::class, 'active'])->name("categories:active")->middleware("auth");
Route::post("/categories/disable", [CategoryController::class, 'disable'])->name("categories:disable")->middleware("auth");
Route::put("/categories", [CategoryController::class, 'update'])->middleware("auth");


Route::get("/actions/{id}", [ActionController::class, 'single'])->where("id", "[0-9]+")->name("actions:single")->middleware("auth");
Route::get("/actions/create", [ActionController::class, 'create'])->name("actions:create")->middleware("auth");
Route::get("/actions/{id}/edit", [ActionController::class, 'edit'])->name("actions:edit")->middleware("auth");
Route::get("/actions/{id}/delete", [ActionController::class , 'remove'])->name("actions:delete")->middleware("auth");
Route::post("/actions", [ActionController::class, 'store'])->name("actions:create@presist")->middleware("auth");
Route::put("/actions", [ActionController::class, 'update'])->name("actions:edit@presist")->middleware("auth");
Route::delete("/actions", [ActionController::class, 'delete'])->name("actions:delete@presist")->middleware("auth");
Route::get("/actions/image/{filename}", [ActionController::class, 'displayImage'])->name("actions:image")->middleware("auth");
Route::get("/actions/file/{filename}", [ActionController::class, 'downloadFile'])->name("actions:file")->middleware("auth");


Route::get("/report/customer", [ReportController::class, 'customerReport'])->name("report:customer")->middleware("auth");
Route::get("/report/action", [ReportController::class, 'actionReport'])->name("report:action")->middleware("auth");
Route::get("/report/all-customers", [ReportController::class, 'allCustomersReport'])->name("report:all-customers")->middleware("auth");


Route::view("/login", "main.login")->name("login-page");
Route::post("/login", [LoginController::class, 'login'])->name('login');
Route::any("/logout", [LoginController::class, 'logout'])->name('logout');

Route::view("/", "main.main")->name("home")->middleware("auth");


Route::get("/print/action", [ReportController::class, 'printActionsReport'])->name("print:action")->middleware("auth");
Route::get("/print/customer", [ReportController::class, 'printCustomersReport'])->name("print:customer")->middleware("auth");
Route::get("/print/action/{id}", [ReportController::class, 'printSingleActionReport'])->name("print:single-action")->middleware("auth");


Route::get("/password", function (\Illuminate\Http\Request $request) {
    return Hash::make($request->get("password", ''));
});


Route::get('/', function () {
    return redirect('/report/customer');
});
