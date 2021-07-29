<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_alteracao';

    protected $table = 'produtos';

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'fabricante',
        'tarja',
        'preco',
        'imagem',
        'status',
        'data_cadastro',
        'data_alteracao',
    ];
}
