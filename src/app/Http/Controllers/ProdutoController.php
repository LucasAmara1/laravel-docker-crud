<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Http\Request;
use App\Http\Helpers\DatatablesHelper;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Services\ImagemService;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    protected $produtos;
    protected $imagens;

    public function __construct(ProdutoService $produtos, ImagemService $imagens)
    {
        $this->produtos = $produtos;
        $this->imagens = $imagens;
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
        $this->authorize('permissao', 'c_produto'); // gate de permissoes

        if ($request->ajax()) {
            $produto = $this->produtos->store($request);
            if ($request->hasfile('imagens')) {
                foreach ($request->imagens as $imagem) {
                    $nome = time() . rand(1, 100) . '.' . $imagem->extension();
                    $img = Image::make($imagem->path());
                    $img->resize(500, 500, function ($const) {
                        $const->aspectRatio();
                    })->save(public_path('images/produtos/')  . $nome);
                    if ($imagem->getClientOriginalName() == $request->imagem_principal) {
                        $principal = 1;
                    } else {
                        $principal = 0;
                    }
                    $this->imagens->store($produto->id, $nome, $principal);
                }
            }

            Session::flash('mensagem', 'Cadastrado com sucesso!');
            return true;
        }
    }

    public function show(Produto $produto)
    {
        $produto = $this->produtos->show($produto);
        $imagem = $this->imagens->show($produto);

        return view('configuracao.produtos.visualizar', compact('produto', 'imagem'));
    }

    public function edit(Produto $produto)
    {
        $produto = $this->produtos->show($produto);
        $imagem = $this->imagens->show($produto);
        return view('configuracao.produtos.editar', compact('produto', 'imagem'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        Session::flash('mensagem', 'Editado com sucesso!');
        return true;
    }

    public function destroy(Produto $produto)
    {
        $this->produtos->destroy($produto);
        return redirect()->route('produtos.index')->with('mensagem', 'Excluído com sucesso!');
    }
}
