<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProdutoController,
};

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware('auth')->group(static function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('produtos', ProdutoController::class);
    
});

require __DIR__ . '/auth.php';
