<?php

use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('perfil/{id}', [App\Http\Controllers\PerfilController::class, 'init'])->name('perfil');
    Route::get('perfil}', [App\Http\Controllers\PerfilController::class, 'perfiluser'])->name('perfiluser');

});
