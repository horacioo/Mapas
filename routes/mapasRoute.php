<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mapas\CadastroController;



Route::middleware('auth')->group(function () {

    Route::get('/mapas/cadastro', [CadastroController::class, 'index'])->name('mapas.cadastro');
});
