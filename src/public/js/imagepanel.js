var loadImagens = function(input) {
    $("img").remove();
    if(input.files.length > 0){
        for (let i = 0; i < input.files.length; i++) {
            var img = $('<img />', {
                id: 'img'+i,
                width: 100,
                height: 100
            })
            img[0].src = URL.createObjectURL(input.files[i]);

            img.appendTo($('#imagens'));
            $('#panel-img').prop('hidden', false);
        }
    }else{
        $('#panel-img').prop('hidden', true);
    } 
};