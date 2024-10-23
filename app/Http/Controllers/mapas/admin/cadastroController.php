<?php

namespace App\Http\Controllers\mapas\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cadastroController extends Controller
{
    public function cadastro(){
        return view('mapas.admin.cadastro');
    }
}
