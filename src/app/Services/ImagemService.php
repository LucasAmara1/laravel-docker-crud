<?php

namespace App\Services;

use App\Models\Imagem;
use Illuminate\Support\Facades\File;

class ImagemService
{
    public function store($id_produto, $nome, $principal = 0)
    {
        $imagem = Imagem::create([
            'id_produto' => $id_produto,
            'principal' => $principal,
            'arquivo' => $nome,
            'id_cadastro' => Auth()->user()->id,
            'data_cadastro' => date('Y-m-d H:i:s')
        ]);

        return $imagem;
    }

    public function show($id_produto)
    {
        $imagens = Imagem::select(array(
            'imagens.id',
            'imagens.arquivo'
        ))
            ->join('produtos as p', 'p.id', '=', 'imagens.id_produto')
            ->where('p.id', $id_produto)
            ->get();

        return $imagens;
    }

    public function update($id_produto, $nome, $principal)
    {
        if ($principal == 1) {
            Imagem::where('id_produto', $id_produto)
                ->where('principal', 1)
                ->update(['principal' => 0, 'id_alteracao' => Auth()->user()->id]);
        }

        $imagem = Imagem::create([
            'id_produto' => $id_produto,
            'principal' => $principal,
            'arquivo' => $nome,
            'id_cadastro' => Auth()->user()->id,
            'data_cadastro' => date('Y-m-d H:i:s')
        ]);

        return $imagem;
    }

    public function update_antigas($nome_imagens, $id_produto, $id_estabelecimento)
    {
        $imagens = Imagem::select(array(
            'id',
            'arquivo'
        ))
            ->where('id_produto', $id_produto)
            ->whereNotIn('arquivo', $nome_imagens)
            ->get();

        if (isset($imagens) && sizeof($imagens) > 0) {
            foreach ($imagens as $imagem) {
                $imagem->delete();
                $image_path = public_path('images/produtos/' . $id_estabelecimento . '/' . $imagem->arquivo);
                if ($image_path) {
                    File::delete($image_path);
                }
            }
        }
        return $imagens;
    }

    public function deletar_antigas($id_produto, $id_estabelecimento)
    {
        $imagens = Imagem::select(array(
            'id',
            'arquivo'
        ))
            ->where('id_produto', $id_produto)
            ->get();

        if (isset($imagens) && sizeof($imagens) > 0) {
            foreach ($imagens as $imagem) {
                $imagem->delete();
                $image_path = public_path('images/produtos/' . $id_estabelecimento . '/' . $imagem->arquivo);
                if ($image_path) {
                    File::delete($image_path);
                }
            }
        }
        return $imagens;
    }

    public function principal($id)
    {
        $imagens = Imagem::select(array(
            'imagens.id',
            'imagens.arquivo as path'
        ))
            ->join('produtos as p', 'p.id', '=', 'imagens.id_produto')
            ->where('p.id', $id)
            ->where('imagens.principal', 1)
            ->first();

        return $imagens;
    }

    public function update_principal($id_produto, $nome)
    {
        Imagem::where('id_produto', $id_produto)
            ->where('principal', 1)
            ->update(['principal' => 0, 'id_alteracao' => Auth()->user()->id]);

        Imagem::where('id_produto', $id_produto)
            ->where('arquivo', $nome)
            ->update(['principal' => 1, 'id_alteracao' => Auth()->user()->id]);
    }
}
