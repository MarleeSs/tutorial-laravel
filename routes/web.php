<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function (){
    return "Cobain";
});

Route::redirect('/cobain', '/coba');

// costume fallback
Route::fallback(function (){
    return "Ga ada euy";
});

// get view
Route::get('/hello', function (){
   return view('user.hello', ['name' => 'Marleess']);
});

// regex routing
Route::get('/products/{pId}', function ($pId){
    return "Product $pId";
})->name('product.detail');// named route

// menentukan regex routing
Route::get('/category/{cId}', function ($cId){
    return "Category $cId";
})->where('cId', '[0-9]+'); // named route

// optional routing
Route::get('user/{uId?}', function ($uId = "User facebook"){
   return "User $uId";
});

Route::get('/produk/{id}', function ($produkId){
    $link = route('product.detail', $produkId);
    return "Link $link";
});

Route::get('/produk-redirect/{produkId}', function ($produkId){
   return redirect()->route('product.detail', $produkId);
});
