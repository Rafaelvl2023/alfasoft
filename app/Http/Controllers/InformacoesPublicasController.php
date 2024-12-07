<?php

namespace App\Http\Controllers;

use App\Models\Contato;

class InformacoesPublicasController extends Controller
{
    public function index()
    {
        $contatos = Contato::paginate(5); 
        $quantidadeCadastros = Contato::count();

        return view('contatos', compact('contatos', 'quantidadeCadastros'));
    }
}
