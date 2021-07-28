$(window).on("load", function () {
    $('form').on('submit', function () {
        $('button[type="submit"]').prop('disabled', true).text("Aguarde...");
        setTimeout(function () {
            $('button[type="submit"]').prop('disabled', false).text("Cadastrar");
        }, 5000); // Aqui você define quantos milissegundos a tela deve aguardar.
    });
});