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

    Route::get('perfil/{id}', [LivewirePerfilController::class, 'render'])->name('perfil');

});
