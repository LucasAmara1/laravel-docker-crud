@extends('layouts.app')
@section('content')

<script type="text/javascript" src="{{ asset('js/aksFileUpload.js') }}"></script>

<link rel="stylesheet" href="{{ asset('css/aksFileUpload.css') }}">

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

    <form method="POST" id="produtoForm" enctype="multipart/form-data">
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
                <label for="departamento">Departamento</label>
                <select required name="departamento" class="form-control" id="departamento">
                    <option value="" selected disabled>Selecione o Departamento</option>
                    @foreach ( $departamentos as $value)
                    <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="formula">Fórmula</label>
                <select name="formula" class="form-control select_search_formula" id="formula">
                    <option value="" selected disabled>Selecione a Fórmula</option>
                    @foreach ( $formulas as $value)
                    <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="fabricante">Fabricante</label>
                <select required name="fabricante" class="form-control select_search_fabricante" id="fabricante">
                    <option value="" selected disabled>Selecione o Fabricante</option>
                    @foreach ( $fabricantes as $value)
                    <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="tarja">Tarja</label>
                <select name="tarja" class="form-control" id="tarja">
                    <option value="" selected disabled>Selecione a Tarja</option>
                    @foreach ( $tarjas as $value)
                    <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="referencia">Referência</label>
                <input required type="text" class="form-control" name="referencia" id="referencia"
                    placeholder="Referência do Produto">
            </div>
            <div class="form-group col-md-6">
                <label for="descricao">Descrição</label>
                <textarea required class="form-control" name="descricao" id="descricao" rows="3"
                    placeholder="Descrição do Produto"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label for="principal">Imagens</label>
                <aks-file-upload></aks-file-upload>
                <input id="principal" name="imagem_principal" value="" hidden>
            </div>
        </div>
        <a href="{{route('produtos.index')}}" class="btn btn-secondary mb-4">Voltar</a>
        <button type="submit" class="btn btn-primary float-right mb-4" id="btn-submit">Cadastrar</button>
    </form>
</div>

@include('scripts.estilo-titulo')
@include('scripts.select2-scripts')

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

    $(document).ready(function(){
        $(".select_search_fabricante").select2();
        var selectSpan = $(".selection>span");
        selectSpan.removeClass()
        selectSpan.addClass("form-control");
    });

    $(document).ready(function(){
        $(".select_search_formula").select2();
        var selectSpan = $(".selection>span");
        selectSpan.removeClass()
        selectSpan.addClass("form-control");
    });

})
</script>

@endsection('content')
