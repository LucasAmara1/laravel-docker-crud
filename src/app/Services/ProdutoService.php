<?php

namespace App\Services;

use App\Models\Produto;
use App\Http\Traits\DinheiroTrait;
use App\Http\Traits\ImagemTrait;
use Illuminate\Http\Request;

class ProdutoService
{
    use DinheiroTrait, ImagemTrait;

    private const IMAGEM_PATH = 'images/produtos/';

    public function index()
    {
        $produtos = Produto::select(array(
            'id',
            'nome',
            'preco',
            'tarja',
            'descricao',
        ))
            ->where('status', '!=', 0)
            ->orderBy('nome', 'asc')
            ->get();

        foreach ($produtos as $produto) {
            $produto->preco = $this->formatarReal($produto->preco);
        }

        return $produtos;
    }

    public function store(Request $request)
    {
        $imagem = $this->salvarImagem($request->imagem, self::IMAGEM_PATH);

        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'fabricante' => $request->fabricante,
            'tarja' => $request->tarja,
            'preco' => $this->formatarNumero($request->preco),
            'imagem' => $imagem,
        ]);

        return $produto;
    }

    public function show(int $id)
    {
        $produto = Produto::select(array(
            'id',
            'nome',
            'descricao',
            'fabricante',
            'tarja',
            'preco',
            'imagem',
        ))
            ->where('id', $id)
            ->first();

        $produto->preco === 0 ? $produto->preco = 0 : $produto->preco = substr_replace($produto->preco, ',', -2, 0);
        return $produto;
    }

    public function update(Request $request, int $id)
    {
        $novaImagem = $request->imagem;
        $produto = Produto::find($id, ['id', 'imagem']);

        if ($novaImagem) {
            $novaImagem = $this->salvarImagem($novaImagem, self::IMAGEM_PATH);

            $imagemAntiga = $produto->imagem;
            $this->excluirImagem($imagemAntiga, self::IMAGEM_PATH);
            $produto->imagem = $novaImagem;
        }

        $produto->nome = $request->nome;
        $produto->preco = $this->formatarNumero($request->preco);
        $produto->fabricante = $request->fabricante;
        $produto->tarja = $request->tarja;
        $produto->descricao = $request->descricao;
        $produto->save();
        return $produto;
    }

    public function destroy(int $id)
    {
        $produto = Produto::where('id', $id)->update([
            'status' => 0,
        ]);

        return $produto;
    }
}
