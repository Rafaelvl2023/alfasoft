<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $table = 'contatos';

    protected $fillable = ['nome', 'contato', 'email'];

    public static $regras = [
        'nome' => 'required|min:6|max:255',
        'contato' => 'required|digits:9|unique:contatos,contato',
        'email' => 'required|email|unique:contatos,email',
    ];
}
