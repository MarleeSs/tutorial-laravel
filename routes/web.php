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

Route::get('/coba', function () {
    return "Cobain";
});

Route::redirect('/cobain', '/coba');

// costume fallback
Route::fallback(function () {
    return "Ga ada euy";
});

// get view
Route::get('/hello', function () {
    return view('user.hello', ['name' => 'Marleess']);
});

// regex routing
Route::get('/products/{pId}', function ($pId) {
    return "Product $pId";
})->name('product.detail');// named route

// menentukan regex routing
Route::get('/category/{cId}', function ($cId) {
    return "Category $cId";
})->where('cId', '[0-9]+'); // named route

// optional routing
Route::get('user/{uId?}', function ($uId = "User facebook") {
    return "User $uId";
});

Route::get('/produk/{id}', function ($produkId) {
    $link = route('product.detail', $produkId);
    return "Link $link";
});

Route::get('/produk-redirect/{produkId}', function ($produkId) {
    return redirect()->route('product.detail', $produkId);
});

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);

Route::post('/input/nested/hello', [\App\Http\Controllers\InputController::class, 'helloNested']);

Route::post('/input/hello/encode', [\App\Http\Controllers\InputController::class, 'inputEncode']);

Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/upload/file', [\App\Http\Controllers\UploadController::class, 'upload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);

Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);

Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

Route::get('/middleware/api', function () {
    return 'Middleware Api';
})->middleware(['nama:CBA,401']);

Route::get('/middleware/group', function () {
    return 'Middleware Group';
})->middleware(['nma']);

Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitForm']);
// TODO Route group
