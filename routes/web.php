<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::controller(\App\Http\Controllers\HelloController::class)->group(function () {
    Route::get('/controller/hello/request', 'request');
    Route::get('/controller/hello/{name}', 'hello');
});

Route::controller(\App\Http\Controllers\InputController::class)->group(function () {
    Route::get('/input/hello', 'hello');
    Route::post('/input/hello', 'hello');
    Route::post('/input/nested/hello', 'helloNested');
    Route::post('/input/hello/encode', 'inputEncode');
    Route::post('/input/type', 'inputType');
    Route::post('/input/filter/only', 'filterOnly');
    Route::post('/input/filter/except', 'filterExcept');
    Route::post('/input/filter/merge', 'filterMerge');
});

Route::post('/upload/file', [\App\Http\Controllers\UploadController::class, 'upload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::prefix('/response/type')->group(function () {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

Route::controller(\App\Http\Controllers\CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

Route::controller(\App\Http\Controllers\RedirectController::class)->group(function () {
    Route::get('/redirect/from', 'redirectFrom');
    Route::get('/redirect/to', 'redirectTo');
    Route::get('/redirect/name', 'redirectName');
    Route::get('/redirect/name/{name}', 'redirectHello')
        ->name('redirect-hello');

    // untuk mendapatkan link redirect-hello
    Route::get('/redirect/named', function () {
        return \Illuminate\Support\Facades\URL::route('redirect-hello', ['name' => 'Coba']);
    });

    Route::get('/redirect/action', 'redirectAction');
    Route::get('/redirect/away', 'redirectAway');
});

Route::middleware(['nama:CBA,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return 'Middleware Api';
    });

    Route::get('/group', function () {
        return 'Middleware Group';
    });
});

//Route::middleware(['nama:CBA,401'])->prefix('/middleware')->controller(//)->group(function () {
//    Route::get('/api', function () {
//        return 'Middleware Api';
//    });
//
//    Route::get('/group', function () {
//        return 'Middleware Group';
//    });
//});

Route::get('/url/action', function () {
    return URL::action([\App\Http\Controllers\FormController::class, 'form']);
});

Route::controller(\App\Http\Controllers\FormController::class)->group(function () {
    Route::get('/form', 'form');
    Route::post('/form', 'submitForm');
});

Route::get('/url/current', function () {
    return \Illuminate\Support\Facades\URL::full();
});

Route::controller(\App\Http\Controllers\SessionController::class)->group(function () {
    Route::get('/session/create', 'createSession');
    Route::get('/session/get', 'getSession');
});
