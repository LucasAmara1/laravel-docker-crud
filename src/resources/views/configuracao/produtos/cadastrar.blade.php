@extends('layouts.app')
@section('content')

<div class="conteudo border-0 bg-white  rounded pt-2 pb-1 ">

    <div class="alert alert-danger" id="alert" style="display: none">
        <strong>Ops!</strong> Tivemos algum problema com seus dados.
        <ul>
            <li id="err"></li>
        </ul>
    </div>

    <div class="card-header titulo mb-2">
        <h2>Produtos</h2>
    </div>

    <form action="{{ route('produtos.store' ) }}" method="POST" id="produtoForm" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input required type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Produto">
            </div>
            <div class="form-group col-md-6">
                <label for="preco">Preço</label>
                <input required type="text" class="dinheiro form-control" name="preco" id="preco" placeholder="R$">
            </div>
            <div class="form-group col-md-6">
                <label for="fabricante">Fabricante</label>
                <input required type="text" class="form-control" name="fabricante" id="fabricante"
                placeholder="Fabricante">
            </div>
            <div class="form-group col-md-6">
                <label for="tarja">Tarja</label>
                <input required type="text" class="form-control" name="tarja" id="tarja"
                placeholder="Tarja">
            </div>
            <div class="form-group col-md-6">
                <label for="logo">Imagem</label>
                <input type="file" class="form-control" name="imagem" id="imagem" placeholder="Imagem" onchange="loadImagens(this)">
            </div>
            <div class="form-group col-md-6">
                <label for="descricao">Descrição</label>
                <textarea required class="form-control" name="descricao" id="descricao" rows="3"
                    placeholder="Descrição do Produto"></textarea>
            </div>
        </div>

        <div hidden class="panel panel-default" id="panel-img">
            <div class="panel-heading">
                <h3 class="panel-title">Imagem do produto</h3>
            </div>
            <div class="panel-body" id="imagens">
            </div>
        </div>

        <a href="{{route('produtos.index')}}" class="btn btn-secondary mb-4">Voltar</a>
        <button type="submit" class="btn btn-primary float-right mb-4" id="btn-submit">Cadastrar</button>
    </form>
</div>

@include('scripts.estilo-titulo')
@include('scripts.image-panel')

<script>
    $(document).ready(function() {
        $('.dinheiro').inputmask({
            alias:"currency",
            integerDigits:9,
            digits:2,
            prefix:'',
            radixPoint: ",",
            groupSeparator: ".",
            rightAlign: false,
            digitsOptional: false,
        });
    });
</script>

@endsection('content')