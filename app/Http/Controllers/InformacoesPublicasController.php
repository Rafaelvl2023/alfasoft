<?php

namespace App\Http\Controllers;

use App\Models\Contato;

class InformacoesPublicasController extends Controller
{
    public function index()
    {
        $contatos = Contato::paginate(8);
        $quantidadeCadastros = Contato::count();

        return view('contatos', compact('contatos', 'quantidadeCadastros'));
    }
}
