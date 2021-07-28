jQuery(document).ready(function ($) {
    let colunasArray = [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: true,
            searchable: true
        }
    ];

    colunas.forEach(addColunas);

    function addColunas(item) {
        colunasArray.push(
            {
                data: item,
                name: item
            }
        )
    }

    colunasArray.push(
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }
    )

    $(function () {
        $(document).on('click','.apagar',function(){
            deleteAlert($(this).val());
        });

        $('.yajra-datatable').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "bDestroy": true,
            processing: true,
            serverSide: true,
            ajax: [
                {
                    url: url
                }

            ],
            columns: colunasArray
        });
    });

    $("document").ready(function () {
        setTimeout(function () {
            $("div.alert").remove();
        }, 3000); // 5 secs

    });

    function deleteAlert(id) {
        Swal.fire({
            title: 'Tem certeza que deseja excluir?',
            text: "Essa ação não pode ser revertida!",
            icon: 'warning',
            cancelButtonText: "Não",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            type: "info",
            width: 600,
            height: 100,
        }).then((result) => {
            if (result.value) {
                document.forms['deleteForm' + id].submit();
            }
        })
    }
});
