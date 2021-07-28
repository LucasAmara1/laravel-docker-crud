@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/imagepanel.css') }}">

<div class="conteudo border-0 bg-white  rounded pt-2 pb-1 ">
  <div class="card-header titulo mb-2" style="display: flex; justify-content:  space-between;">
    <div>
        <h2>{{$produto->nome}}</h2>
        <label for="descricao" class="flex-wrap" style="max-width: 550px;word-break: break-all">{{$produto->descricao}}</label>
    </div>
    @if ($principal)
        <img src="{{ asset('images/produtos/'.$estabelecimento.'/'.$principal) }}" alt="{{$produto->nome}}" style="max-width: 100px">
    @endif
  </div>

  <form id="bairroForm">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="preco">Preço</label>
            <input disabled value="{{$produto->preco}}" type="text" class="dinheiro form-control" name="preco" id="preco" placeholder="R$">
        </div>
        <div class="form-group col-md-6">
            <label for="departamento">Departamento</label>
            <input disabled type="text" class="form-control" value="{{$produto->departamento->nome}}"></input>
        </div>
        <div class="form-group col-md-6">
            <label for="formula">Fórmula</label>
            <input disabled type="text" class="form-control" value="{{$produto->formula->nome}}"></input>
        </div>
        <div class="form-group col-md-6">
            <label for="fabricante">Fabricante</label>
            <input disabled type="text" class="form-control" value="{{$produto->fabricante->nome}}"></input>
        </div>
        <div class="form-group col-md-6">
            <label for="tarja">Tarja</label>
            <input disabled type="text" class="form-control" value="{{$produto->tarja->nome}}"></input>
        </div>
        <div class="form-group col-md-6">
            <label for="tarja">Referência</label>
            <input disabled type="text" class="form-control" value="{{$produto->referencia}}"></input>
        </div>
    </div>

    <div class="panel panel-default" id="panel-img">
        <div class="panel-heading">
            <h3 class="panel-title">Imagens do produto</h3>
        </div>
        <div class="panel-body" id="imagens">
            @foreach ($imagens as $path)
                <img src="{{ asset('images/produtos/'.$estabelecimento.'/'.$path->arquivo) }}" alt="{{$produto->nome}}" style="width: 120px; height: 120px;">
            @endforeach
        </div>
    </div>

    <a href="{{route('produtos.index')}}" class="btn btn-secondary mb-4">Voltar</a>
  </form>

</div>

@include('scripts.estilo-titulo')

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
    })
</script>

@endsection('content')
