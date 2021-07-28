@extends('layouts.app')

@section('content')

@if(session('mensagem'))
<div class="alert alert-success">
    <p>{{session('mensagem')}}</p>
</div>
@endif

<div class="conteudo border-0 bg-white rounded pt-2 pb-2">
    <div class="card-header titulo">
        <h2>Produtos</h2>
    </div>
    <div class="btn-toolbar mb-2 float-right" role="toolbar" aria-label="Toolbar with button groups">
        <div class="pt-2">
            <a href="{{route('produtos.create')}}" class="btn" role="button" aria-disabled="true">Novo</a>
        </div>
    </div>
</div>
<div class="conteudo border-0 bg-white  rounded pt-2 pb-2">
    <div class="mt-2">
        <table class="table table-striped yajra-datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
    </div>
    <hr>
</div>

@include('scripts.datatables-scripts')
@include('scripts.datatables-style')

<style>
    .titulo {
        border-radius: 5px !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0);
    }

    .conteudo {
        margin: auto;
        padding-right: 20px;
        padding-left: 20px;
    }

    .btn {
        background-color: #636f83;
        color: #ffffff;
    }
</style>

<style>
    td:nth-child(5) {
        display: inline-block;
        width: 200px !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
        overflow: hidden !important;
    }
</style>

<script type="text/javascript">
    const url = 'produtos.index';

        const colunas = ['nome','preco' ,'descricao'];
</script>

@endsection('content')