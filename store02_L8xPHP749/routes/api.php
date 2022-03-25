<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user', function () {
    $user = User::find(1)->load('addresses');
    return [
        'user' => $user,
    ];
});

Route::get('/test', function () {
    $id = request('id');
    if (!$id) {
        return User::get();
    }
    return [User::findOrFail($id)];
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
    Route::prefix('/products')->group(function () {
        Route::get('/', [AdminController::class, 'products'])->name('adminProducts');
        Route::post('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');
    });
    Route::prefix('/categories')->group(function () {
        Route::get('/', [AdminController::class, 'categories'])->name('adminCategories');
        Route::post('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
    });
    Route::get('/enterAsUser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');

    //Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories'); // Код для BLADE
    Route::post('/exportCategories', [AdminController::class, 'exportCategories']); // Код для VueJS
    Route::post('/exportProducts', [AdminController::class, 'exportProducts'])->name('exportProducts');

    Route::post('/importCategoriesFromFile', [AdminController::class, 'importCategoriesFromFile'])->name('importCategoriesFromFile');
    Route::post('/importProductsFromFile', [AdminController::class, 'importProductsFromFile'])->name('importProductsFromFile');
    Route::prefix('roles')->group(function () {
        Route::post('/add', [AdminController::class, 'addRole'])->name('addRole');
        Route::post('/addRoleToUser', [AdminController::class, 'addRoleToUser'])->name('addRoleToUser');
    });
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'cart'])->name('cart');
    Route::get('/info', [CartController::class, 'info']); // Code for Vue-router
    Route::get('/productsQuantity', [CartController::class, 'productsQuantity']); // Код для VueJS
    Route::post('/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');
});

Route::get('/getCategories', [HomeController::class, 'getCategories']); // Code for Vue-router
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/category/{category}/getProducts', [HomeController::class, 'getProducts']);
Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/save', [ProfileController::class, 'save'])->name('saveProfile');

Auth::routes();
