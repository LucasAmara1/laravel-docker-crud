<?php

namespace App\Services;

use App\Models\Produto;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProdutoService
{
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

        foreach ($produtos as $p) {
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
        $imageName = '';

        if ($request->imagem) {
            $imageName = time() . '.' . $request->imagem->extension();
            $img = Image::make($request->imagem->path());
            $img->resize(200, 200, function ($const) {
                $const->aspectRatio();
            })->save(public_path('images/produtos/')  . $imageName);
        }

        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'fabricante' => $request->fabricante,
            'tarja' => $request->tarja,
            'preco' => preg_replace('/\D/', '', $request->preco),
            'imagem' => $imageName,
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
            'imagem',
        ))
            ->where('id', $id)
            ->first();

        $produto->preco === 0 ? $produto->preco = 0 : $produto->preco = substr_replace($produto->preco, ',', -2, 0);
        return $produto;
    }

    public function update($request, $id)
    {
        if ($request->imagem) {
            $imageName = time() . '.' . $request->imagem->extension();
            $img = Image::make($request->imagem->path());
            $img->resize(200, 200, function ($const) {
                $const->aspectRatio();
            })->save(public_path('images/produtos/')  . $imageName);

            $imagem_antiga = Produto::find($id, ['imagem'])->imagem;
            if ($imagem_antiga) {
                $image_path = public_path('images/produtos/' . $imagem_antiga);
                if ($image_path) {
                    File::delete($image_path);
                }
            }

            return Produto::where('id', $id)->update([
                'nome' => $request->nome,
                'preco' => preg_replace('/\D/', '', $request->preco),
                'fabricante' => $request->fabricante,
                'tarja' => $request->tarja,
                'imagem' => $imageName,
                'descricao' => $request->descricao,
            ]);

        } else {
            return Produto::where('id', $id)->update([
                'nome' => $request->nome,
                'preco' => preg_replace('/\D/', '', $request->preco),
                'fabricante' => $request->fabricante,
                'tarja' => $request->tarja,
                'descricao' => $request->descricao,
            ]);
        }
    }

    public function destroy($id)
    {
        $produto = Produto::where('id', $id)->update([
            'status' => 0,
        ]);

        return $produto;
    }
}
