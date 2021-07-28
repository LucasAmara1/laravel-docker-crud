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

    public function datatable_form($data)
    {
        $botao_editar = '';
        $botao_remover = '';
        $botao_visualizar = '';

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use ($botao_editar, $botao_remover, $botao_visualizar) {

                $this->id_linha++;
                $id = $data->id;

                $botao_editar = '<a href="' . route('' . $this->rota . '.edit', $id) . '" class="edit  btn-sm pr-2" title="Editar">' . '<image width="20px" class="" src="' . asset("icons/crud/pencil-square.svg") . '" alt="" >' . '</a>';

                $botao_remover = '<form action="' . route('' . $this->rota . '.destroy', $id) . '" name="deleteForm' . $this->id_linha . '" method="POST" onsubmit="event.preventDefault();">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" id="apagar' . $this->id_linha . '" class="apagar" title="Apagar" value="' . $this->id_linha . '" style="border:0;background-color: Transparent;"  class="">' . '<image width="" class="" src="' . asset("icons/crud/trash.svg") . '" alt="" >' . '</button>
                    </form>';

                $botao_visualizar = '<a href="' . route('' . $this->rota . '.show', $id) . '" class="edit  btn-sm pr-2" title="Visualizar">' . '<image width="20px;" class="" src="' . asset("icons/crud/eye.svg") . '" alt="" >' . '</a>';

                return '
                <div class="d-flex" >
                    ' . $botao_visualizar . '
                    ' . $botao_editar . '
                    ' . $botao_remover . '
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
