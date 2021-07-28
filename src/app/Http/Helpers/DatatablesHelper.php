<?php

namespace App\Http\Helpers;

use Yajra\DataTables\DataTables;

class DatatablesHelper
{

    private $rota;
    private $id_linha;

    public function __construct($rota)
    {
        $this->rota = $rota;
        $this->id_linha = 0;
    }


    public function datatable_form($data, $permissao_editar = true, $permissao_apagar = true, $permissao_visualizar = true)
    {
        $botao_e = '';
        $botao_r = '';
        $botao_v = '';

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use ($permissao_editar, $botao_e, $permissao_apagar, $botao_r, $permissao_visualizar, $botao_v) {

                $this->id_linha++;
                $id_encriptado = encrypt($data->id);

                if ($permissao_editar) {
                    $botao_e = '<a href="' . route('' . $this->rota . '.edit', $id_encriptado) . '" class="edit  btn-sm pr-2" title="Editar">' . '<image width="20px" class="" src="' . asset("icons/crud/pencil-square.svg") . '" alt="" >' . '</a>';
                };

                if ($permissao_apagar) {
                    $botao_r = '<form action="' . route('' . $this->rota . '.destroy', $id_encriptado) . '" name="deleteForm' . $this->id_linha . '" method="POST" onsubmit="event.preventDefault();">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" id="apagar' . $this->id_linha . '" class="apagar" title="Apagar" value="' . $this->id_linha . '" style="border:0;background-color: Transparent;"  class="">' . '<image width="" class="" src="' . asset("icons/crud/trash.svg") . '" alt="" >' . '</button>
                    </form>';
                };

                if ($permissao_visualizar) {
                    $botao_v = '<a href="' . route('' . $this->rota . '.show', $id_encriptado) . '" class="edit  btn-sm pr-2" title="Visualizar">' . '<image width="20px;" class="" src="' . asset("icons/crud/eye.svg") . '" alt="" >' . '</a>';
                }

                return '
                <div class="d-flex" >
                    ' . $botao_v . '
                    ' . $botao_e . '
                    ' . $botao_r . '
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
