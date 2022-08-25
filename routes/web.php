<?php

use App\Http\Livewire\PerfilController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('perfil/{$name}',[PerfilController::class, 'render' ])->name('perfil');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');
});
