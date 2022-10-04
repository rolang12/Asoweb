<?php

use App\Events\ExampleEvent;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/fire', function () {
//     event(new ExampleEvent);
//     return 'Fired';
// });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('publicacion/{id}', [App\Http\Controllers\PublicacionController::class, 'buscar'])->name('publicacion');

    Route::get('perfil/{id}', [App\Http\Controllers\PerfilController::class, 'init'])->name('perfil');
    Route::get('perfil', [App\Http\Controllers\PerfilController::class, 'perfiluser'])->name('perfiluser');

});
