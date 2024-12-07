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


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Contato::$regras);

        if ($validator->fails()) {
            return response()->json(['erros' => $validator->errors()], 422);
        }

        $contato = Contato::find($id);

        if (!$contato) {
            return response()->json(['mensagem' => 'Contato não encontrado'], 404);
        }

        $contato->update($request->all());

        return response()->json(['contato' => $contato]);
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
