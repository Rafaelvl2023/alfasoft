<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::paginate(8);
        $quantidadeCadastros = Contato::count();

        return view('adminContatos', compact('contatos', 'quantidadeCadastros'));
    }

    public function showInformacoes($id)
    {
        $contato = Contato::findOrFail($id);
        return view('informacoes', compact('contato'));
    }

    public function showExcluir($id)
    {
        $contato = Contato::findOrFail($id);
        return view('excluir', compact('contato'));
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
        return view('editar', compact('contato'));
    }

    public function update(Request $request, $id)
    {
        $contato = Contato::findOrFail($id);

        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'contato' => 'required|numeric|digits:9',
            'email' => 'required|email|unique:contatos,email,' . $contato->id,
        ]);

        $contato->update($validatedData);

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

        return redirect()->route('adminContatos')->with('mensagem', 'Contato deletado com sucesso');
    }
}
