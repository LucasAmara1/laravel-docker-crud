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
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input required value="{{$produto->nome}}" type="text" class="form-control" name="nome" id="nome"
                    placeholder="Nome do Produto">
            </div>
            <div class="form-group col-md-6">
                <label for="preco">Preço</label>
                <input required value="{{$produto->preco}}" type="text" class="dinheiro form-control" name="preco"
                    id="preco" placeholder="R$">
            </div>
            <div class="form-group col-md-6">
                <label for="departamento">Departamento</label>
                <select required name="departamento" class="form-control" id="departamento">
                    <option value="" selected disabled>Selecione o Departamento</option>
                    @foreach ( $departamentos as $value)
                    <option @if($produto->departamento->id == $value->id) selected @endIf
                        value={{$value->id}}>{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="formula">Fórmula</label>
                <select name="formula" class="form-control select_search_formula" id="formula">
                    <option value="" selected disabled>Selecione a Fórmula</option>
                    @foreach ( $formulas as $value)
                    <option @if($produto->formula->id == $value->id) selected @endIf
                        value={{$value->id}}>{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="fabricante">Fabricante</label>
                <select required name="fabricante" class="form-control select_search_fabricante" id="fabricante">
                    <option value="" selected disabled>Selecione o Fabricante</option>
                    @foreach ( $fabricantes as $value)
                    <option @if($produto->fabricante->id == $value->id) selected @endIf
                        value={{$value->id}}>{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="tarja">Tarja</label>
                <select name="tarja" class="form-control" id="tarja">
                    <option value="" selected disabled>Selecione a Tarja</option>
                    @foreach ( $tarjas as $value)
                    <option @if($produto->tarja->id == $value->id) selected @endIf value={{$value->id}}>{{$value->nome}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="referencia">Referência</label>
                <input required value="{{$produto->referencia}}" type="text" class="form-control" name="referencia" id="referencia" placeholder="Referência do Produto">
            </div>
            <div class="form-group col-md-6">
                <label for="descricao">Descrição</label>
                <textarea required class="form-control" name="descricao" id="descricao" rows="3"
                    placeholder="Descrição do Produto">{{$produto->descricao}}</textarea>
            </div>
            <div class="form-group col-md-12">
                <label for="imagens">Imagens</label>
                <aks-file-upload></aks-file-upload>
                @foreach ( $imagens as $img)
                <input hidden class="img-produto" id="img{{ $loop->iteration }}" type="text" value={{$img->arquivo}}>
                @endforeach
                <input hidden id="principal" name="imagem_principal" value={{$principal}}>
                <input hidden id="estabelecimento" name="estabelecimento" value={{$estabelecimento}}>
                <input hidden id="id_produto" name="id_produto" value={{$produto->id_encriptado}}>
            </div>
        </div>
        <a href="{{route('produtos.index')}}" class="btn btn-secondary mb-4">Voltar</a>
        <button type="submit" class="btn btn-primary float-right mb-4">Salvar</button>
    </form>
</div>

@include('scripts.estilo-titulo')
@include('scripts.select2-scripts')

<script>

    $(function () { // Inicializando o "aks file upload"
        $("aks-file-upload").aksFileUpload({
            // options here,
            fileUpload:"#uploadInput",
            input:"#imagens",
            multiple:true,
            maxFile: 3,
            maxSize:"2 MB",
            label:"Clique aqui ou Arraste e solte imagens",
            maxFileError: "Limite de arquivos excedido. Limite máximo:",
            maxSizeError: "excedeu o tamanho máximo de arquivo. Tamanho máximo:",
            fileTypeError: "é um formato não permitido.",
            fileType: ["bmp", "gif", "jpeg", "jpg", "png"]
        });
    });

    base_url = "<?php echo asset(''); ?>";
    var storedFiles = []; // Gera array de imagens do "aks file upload"
    var preloaded_images = [];
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

        var estabelecimento = $('#estabelecimento').val();
        var imagens = Array.prototype.slice.call($(".img-produto"));
        imagens.forEach(img => {
            var nome_img = img.value;
            preloaded_images.push(nome_img);
            var imagem = new Image();
            imagem.src = base_url + 'images/produtos/' + estabelecimento + '/' + nome_img;
            var size_img;
            var fileTypeExtension;
            imagem.onload = function() {
                var size = performance.getEntriesByName(this.src)[0];
                size_img = bytesToSize(size.transferSize);
                fileTypeExtension = nome_img.split(".").pop().toLowerCase();
                var check_icon = base_url +"icons/crud/check-mark-black-outline.svg";
                var delete_icon = base_url +"icons/crud/delete.svg";
                if($('#principal').val() == nome_img){
                    var principalButton =
                        '<div class="aks-file-upload-principal-check" id="'+ nome_img +'" data-toggle="tooltip" title="Imagem de capa" onclick="principal(this)" data-principal="' +
                        nome_img +
                        '"><img class="aks-file-upload-principal-icon" src="'+ check_icon +'" alt=""></div>';
                }else{
                    var principalButton =
                        '<div class="aks-file-upload-principal" id="'+ nome_img +'" data-toggle="tooltip" title="Imagem de capa" onclick="principal(this)" data-principal="' +
                        nome_img +
                        '"><img class="aks-file-upload-principal-icon" src="'+ check_icon +'" alt=""></div>';
                }

                var deleteButton =
                    '<div class="aks-file-upload-delete" data-delete="' +
                    nome_img +
                    '"><img class="aks-file-upload-delete-icon" title="Excluir" src="'+ delete_icon +'" alt=""></div>';

                var imagehtml =
                    '<div data-file="' +
                    nome_img +
                    '" data-file-type="' +
                    fileTypeExtension +
                    '" class="aks-file-upload-preview ">' +
                    '<div class="aks-file-upload-p-header"><div class="aks-file-upload-image">' + '<img src="' +
                    imagem.src +
                    '" alt="' +
                    nome_img +
                    '" data-file="' +
                    nome_img +
                    '" />' +
                    '</div><div class="aks-file-upload-p-header-content">' +
                    '<span class="aks-file-upload-title">' +
                    nome_img +
                    "</span>" +
                    '<span class="aks-file-upload-size">' +
                    size_img +
                    "</span>" +
                    "</div>" +
                    principalButton + deleteButton +
                    '</div></div>';
                    var preview = $(".aks-file-upload-content");

                    $(preview).append(imagehtml);
            }
        });
    })

    function bytesToSize(bytes) {
        var sizes = ["BYTE", "KB", "MB", "GB", "TB"];
        if (bytes == 0) return "0 BYTE";
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
    }

    function principal(div) {
        $(".aks-file-upload-principal-check").attr("class", "aks-file-upload-principal");
        $('#principal').val(div.id);
        $(div).attr("class", "aks-file-upload-principal-check");
    }

    $("#produtoForm").on("submit", function (e) {
        e.preventDefault();//stop submit event
        $('#btn-submit').prop('disabled', true);
        var id_produto = $('#id_produto').val();
        var formData = new FormData($(this)[0]);
        for (let i = 0; i < storedFiles.length; i++) {
            formData.append('novas_imagens[]', storedFiles[i]);
        }
        for (let i = 0; i < preloaded_images.length; i++) {
            formData.append('antigas_imagens[]', preloaded_images[i]);
        }
        $.ajax({
            type: 'POST',
            url: '/produtos/' + id_produto,
            data: formData,
            contentType: false,
            processData: false,
            success: function(/*response*/) { // your success handler
                window.location.href = "/produtos";
            },
            error: function(data) { // your error handler
                if(!data.responseJSON){
                    $('#err').html('Ocorreu um erro de cadastro, tente novamente.');
                }else{
                    $('#err').html('');
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#err').append(value+"<br>");
                    });
                }
                $('#alert').css('display', 'block');
                $('#btn-submit').prop('disabled', false);
        }
        });
    });
</script>

@endsection('content')
