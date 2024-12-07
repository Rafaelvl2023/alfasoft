<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::all();
        return response()->json(['contatos' => $contatos]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Contato::$regras);

        if ($validator->fails()) {
            return response()->json(['erros' => $validator->errors()], 422);
        }

        $contato = Contato::create($request->all());

        return response()->json(['contato' => $contato], 201);
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
            return response()->json(['mensagem' => 'Contato não encontrado'], 404);
        }

        $contato->delete();

        return response()->json(['mensagem' => 'Contato deletado com sucesso']);
    }
}
