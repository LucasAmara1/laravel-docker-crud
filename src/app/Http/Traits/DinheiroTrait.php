<?php

namespace App\Http\Traits;

trait DinheiroTrait
{
    public function formatarReal($preco)
    {
        if ($preco) {
            $real_total = substr($preco, 0, -2);
            $centavos_total = str_pad(substr($preco, -2), 2, "0", STR_PAD_LEFT);
            $valor_total = $real_total . '.' . $centavos_total;
            $preco = 'R$ ' . number_format($valor_total, 2, ',', '.');
        } else {
            $preco = 'R$ 0,00';
        }

        return $preco;
    }

    public function formatarNumero($preco)
    {
        return preg_replace('/\D/', '', $preco);
    }
}