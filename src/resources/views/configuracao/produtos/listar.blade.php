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
            <a href="{{route('produtos.create')}}" class="btn btn-driip" role="button" aria-disabled="true">Novo</a>
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
                    <th>Tarja</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
    </div>
    <hr>
</div>

@include('scripts.datatables-scripts')
@include('styles.datatables-style')
@include('styles.pages-style')

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

        const colunas = ['nome','preco', 'tarja' ,'descricao'];
</script>

@endsection('content')