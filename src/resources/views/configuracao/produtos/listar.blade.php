@extends('layouts.app')

@section('content')
    @if(session('mensagem'))
        <div class="alert alert-success">
            <p>{{session('mensagem')}}</p>
        </div>
    @endif

    <div class="conteudo border-0 bg-white rounded pt-2 pb-2">
        <div class="tab-content " id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="btn-toolbar conteudo justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <div>
                    </div>
                    @can('permissao', 'c_produto')
                        <div class="pt-2">
                            <a href="{{route('produtos.create')}}" class="btn btn-primary" role="button"
                            aria-disabled="true">Novo</a>
                        </div>
                    @endcan
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
            </div>
        </div>
    </div>

    @include('scripts.datatables-scripts')
    @include('scripts.estilo-tabela')

    <style>
        .titulo{
            border-radius: 10px!important;
            border-bottom: 1px solid rgba(0, 0, 0, 0);
        }
        .conteudo{
            margin: auto;
            padding: 20px;
        }

    </style>

    <style>
        td:nth-child(5){
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
