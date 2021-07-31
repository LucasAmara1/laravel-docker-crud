@extends('layouts.app')
@section('content')

<div class="conteudo border-0 bg-white  rounded pt-2 pb-1 ">
    
    @include('layouts.alert-danger')

    <div class="card-header titulo mb-2">
        <h2>Produtos</h2>
    </div>

    <form method="POST" action="{{ route('produtos.update', $produto->id ) }}" id="produtoForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input  value="{{$produto->nome}}" type="text" class="form-control" name="nome" id="nome"
                    placeholder="Nome do Produto">
            </div>
            <div class="form-group col-md-6">
                <label for="preco">Preço</label>
                <input required value="{{$produto->preco}}" type="text" class="dinheiro form-control" name="preco"
                    id="preco" placeholder="R$">
            </div>
            <div class="form-group col-md-6">
                <label for="fabricante">Fabricante</label>
                <input required value="{{$produto->fabricante}}" type="text" class="form-control" name="fabricante"
                    id="fabricante" placeholder="Fabricante">
            </div>
            <div class="form-group col-md-6">
                <label for="tarja">Tarja</label>
                <input required value="{{$produto->tarja}}" type="text" class="form-control" name="tarja" id="tarja"
                    placeholder="Tarja">
            </div>
            <div class="form-group col-md-6">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" name="imagem" id="imagem" placeholder="Imagem"
                    onchange="loadImagens(this)">
            </div>
            <div class="form-group col-md-6">
                <label for="descricao">Descrição</label>
                <textarea required class="form-control" name="descricao" id="descricao" rows="3"
                    placeholder="Descrição do Produto">{{$produto->descricao}}</textarea>
            </div>
        </div>

        <div class="panel panel-default" id="panel-img">
            <div class="panel-heading">
                <h3 class="panel-title">Imagem do produto</h3>
            </div>
            <div class="panel-body" id="imagens">
                @if ($produto->imagem)
                <img src="{{ asset('images/produtos/'.$produto->imagem) }}" alt="{{$produto->nome}}"
                    style="width: 100px; height: 100px;">
                @endif
            </div>
        </div>

        <a href="{{route('produtos.index')}}" class="btn btn-driip2 mb-4">Voltar</a>
        <button type="submit" class="btn btn-driip float-right mb-4">Salvar</button>
    </form>
</div>

@include('styles.pages-style')
@include('scripts.image-panel')

<script>
    $( document ).ready(function() {
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