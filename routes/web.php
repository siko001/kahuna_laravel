<?php

use App\Models\Tag;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Web Routes
Route::view('/', 'index');
Route::get('/', [ProductController::class, "displayAllProducts", "displayTotalRegisteredProducts"]);
Route::view('/login', 'login');
Route::view('/sign-up', 'login');
Route::get("/help-center", [TechController::class, "getAllTechs"]);
Route::get('/technicians/specialized/{type}', [TechController::class, 'showSpecializedTechnicians'])->name('technicians.specialized');
Route::get('/technicians/by-product/{product}', [TechController::class, 'getTechniciansByProduct'])
    ->name('technicians.byProduct');

//register Products Routes
Route::get("/register-product", [ProductController::class, "displayProducts"]);

//profile-settings
Route::view('/profile', 'profile-settings');
Route::put("/profile-settings/{user}", [UserController::class, "changeProfileSettings"]);

//password-settings
Route::view("/change-password", 'change-password');
Route::put("/change-password/{user}", [UserController::class, 'changePassword']);
//forgotten password


//product-settings

Route::get("/product-settings", [ProductController::class, 'displayRegisteredProducts']);
Route::delete("/delete-product/{id}", [ProductController::class, 'deleteProduct']);

//contact-form
Route::get('/contact', [ContactController::class, 'getView']);
Route::post('/contact-form', [ContactController::class, 'submitForm']);

//register product to user
route::get("/addProduct/{product}", [ProductController::class, 'addNewProduct']);



//User Routes
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


//Admin Pages
Route::view("/add-product", "add-product", ["tags" => Tag::all()]);
Route::Post("/add-new-product", [ProductController::class, "addProduct"]);

//technician Pages
Route::view('/login-tech', "login-tech");
Route::post("/login-user-tech", [TechController::class, "login"]);
Route::view('/register-tech', "technician-registration", ['products' => Product::all()]);
Route::post('/register-technician', [TechController::class, 'registerTech']);
Route::post('/logout-tech', [TechController::class, 'logout'])->name("logout-tech");
Route::view("/product-tech", "products-tech");
Route::get("/users",  [UserController::class, "getAllUsers"]);

//to continue
Route::put("/profile-settings/tech/{id}", [TechController::class, "changeProfileSettings"]);
Route::view("change-password/tech", 'change-password');
Route::put("/change-password/tech/{id}", [TechController::class, 'changePassword']);

//ajax call to check the username
Route::post("/registerusername", [UserController::class, "checkUsernameAvailability"]);
//ajax call to check the email
Route::post("/registeremail", [UserController::class, "checkEmailAvailability"]);
