<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Illuminate\Http\Request;
use App\Http\Helpers\DatatablesHelper;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;

class ProdutoController extends Controller
{
    protected $produtos;

    public function __construct(ProdutoService $produtos)
    {
        $this->produtos = $produtos;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $produtos = $this->produtos->index();
            $tabela = (new DatatablesHelper('produtos'))->datatable_form($produtos);
            return $tabela;
        }

        return view('configuracao.produtos.listar');
    }

    public function create()
    {
        $produtos = $this->produtos;
        return view('configuracao.produtos.cadastrar', compact('produtos'));
    }

    public function store(StoreProdutoRequest $request)
    {
        $this->produtos->store($request);
        return redirect()->route('produtos.index')->with('mensagem', 'Cadastrado com sucesso!');
    }

    public function show(int $id)
    {
        $produto = $this->produtos->show($id);
        return view('configuracao.produtos.visualizar', compact('produto'));
    }

    public function edit(int $id)
    {
        $produto = $this->produtos->show($id);
        return view('configuracao.produtos.editar', compact('produto'));
    }

    public function update(UpdateProdutoRequest $request, int $id)
    {
        $this->produtos->update($request, $id);
        return redirect()->route('produtos.index')->with('mensagem', 'Editado com sucesso!');
    }

    public function destroy(int $id)
    {
        $this->produtos->destroy($id);
        return redirect()->route('produtos.index')->with('mensagem', 'Excluído com sucesso!');
    }
}
