<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mapas\admin\cadastroController;


Route::middleware('auth')->group(function () {
    Route::get('/mapas/admin/cadastro', [cadastroController::class, 'cadastro'])->name('mapa.admin.criar');
                
});