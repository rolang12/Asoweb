<?php

use App\Http\Livewire\PerfilController as LivewirePerfilController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login',['page' => 'Login']);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('publicacion/{id}', [App\Http\Controllers\PublicacionController::class, 'buscar'])->name('publicacion');

    Route::get('perfil/{id}', [LivewirePerfilController::class, 'render'])->name('perfil');

});
