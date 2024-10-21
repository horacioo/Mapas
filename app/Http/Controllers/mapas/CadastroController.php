<?php

namespace App\Http\Controllers\Mapas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index(){ return view("mapas/cadastro"); }

}
