@extends('layouts.app')
@section('content')

<div class="conteudo border-0 bg-white  rounded pt-2 pb-1 ">
  <div class="card-header titulo mb-2" style="display: flex; justify-content:  space-between;">
    <div>
        <h2>{{$produto->nome}}</h2>
        <label for="descricao" class="flex-wrap" style="max-width: 550px;word-break: break-all">{{$produto->descricao}}</label>
    </div>
    @if ($produto->imagem)
        <img src="{{ asset('images/produtos/'.$produto->imagem) }}" alt="{{$produto->nome}}" style="max-width: 100px">
    @endif
  </div>

  <form id="bairroForm">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="preco">Preço</label>
            <input disabled value="{{$produto->preco}}" type="text" class="dinheiro form-control" name="preco" id="preco" placeholder="R$">
        </div>
        <div class="form-group col-md-4">
            <label for="tarja">Tarja</label>
            <input disabled type="text" class="form-control" value="{{$produto->tarja}}"></input>
        </div>
        <div class="form-group col-md-4">
            <label for="fabricante">Fabricante</label>
            <input disabled type="text" class="form-control" value="{{$produto->fabricante}}"></input>
        </div>
    </div>
    <a href="{{route('produtos.index')}}" class="btn btn-driip2 mb-4">Voltar</a>
  </form>

</div>

@include('styles.pages-style')

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
