<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class ProdutoService
{
    public function index()
    {
        $produtos = Produto::select(array(
            'id',
            'nome',
            'preco',
            'descricao',
            'referencia',
        ))
            ->where('status', '!=', 0)
            ->orderBy('nome', 'asc')
            ->get();

        foreach ($produtos as $p){
            if ($p->preco) {
                $real_total = substr($p->preco, 0, -2);
                $centavos_total = str_pad(substr($p->preco, -2), 2, "0", STR_PAD_LEFT);
                $valor_total = $real_total . '.' . $centavos_total;
                $p->preco = 'R$ ' . number_format($valor_total, 2, ',', '.');
            } else {
                $p->preco = 'R$ 0,00';
            }
        }
        return $produtos;
    }

    public function store($request)
    {
        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'fabricante' => $request->fabricante,
            'tarja' => $request->tarja,
            'preco' => preg_replace('/\D/', '', $request->preco),
        ]);

        return $produto;
    }

    public function show($id)
    {
        $produto = Produto::select(array(
            'id',
            'nome',
            'descricao',
            'fabricante',
            'tarja',
            'preco',
            'status'
        ))
            ->where('id', $id)
            ->first();

            $produto->preco === 0 ? $produto->preco = 0 : $produto->preco = substr_replace($produto->preco, ',', -2, 0) ;
        return $produto;
    }

    public function update($request, $id)
    {
        $produto = Produto::where('id', $id)->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'ifabricante' => $request->fabricante,
            'itarja' => $request->tarja,
            'preco' => preg_replace('/\D/', '', $request->preco),
        ]);

        return $produto;
    }

    public function destroy($id)
    {
        $produto = Produto::where('id', $id)->update([
            'status' => 0,
        ]);

        return $produto;
    }

}
