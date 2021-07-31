<?php

namespace App\Http\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

trait ImagemTrait
{
    public function salvarImagem($imagem = null, String $path): String
    {
        $nomeImagem = time() . '.' . $imagem->extension();
        $imagem = Image::make($imagem->path());
        $imagem->resize(200, 200, function ($const) {
            $const->aspectRatio();
        })->save(public_path($path . $nomeImagem));

        return $nomeImagem;
    }

    public function excluirImagem($imagem, String $path): void
    {
        if ($imagem) {
            $image_path = public_path($path . $imagem);
            if ($image_path) {
                File::delete($image_path);
            }
        }
    }
}
