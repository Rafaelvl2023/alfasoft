<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContatoController extends Controller
{
    public function index()
    {
        // Pega todos os contatos do banco de dados
        $contatos = Contato::paginate(5);

        // Retorna a view 'adminContatos' com os dados dos contatos
        return view('adminContatos', compact('contatos'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Contato::$regras);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $contato = Contato::create($request->all());

        return redirect()->route('formRegistro')->with('status', 'Contato cadastrado com sucesso!');
    }


    public function edit($id)
    {
        $contato = Contato::findOrFail($id);
        return view('contatos.edit', compact('contato')); 
    }

    public function update(Request $request, $id)
    {
        $contato = Contato::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'contato' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $contato->update($validated);

        return redirect()->route('adminContatos')->with('mensagem', 'Contato atualizado com sucesso!');
    }

    public function show($id)
    {
        $contato = Contato::find($id);

        if (!$contato) {
            return response()->json(['mensagem' => 'Contato não encontrado'], 404);
        }

        return response()->json(['contato' => $contato]);
    }

    public function destroy($id)
    {
        $contato = Contato::find($id);

        if (!$contato) {
            return redirect()->route('contatos.index')->with('mensagem', 'Contato não encontrado');
        }

        $contato->delete();

        // Redireciona para a rota adminContatos após a exclusão do contato
        return redirect()->route('adminContatos')->with('mensagem', 'Contato deletado com sucesso');
    }
}
