
    $.ajaxSetup({
        beforeSend: function () {
            //создаем прилоадер
            var loading = '<div id="floatingBarsG">';
            loading += '<div class="blockG" id="rotateG_01"></div>';
            loading += '<div class="blockG" id="rotateG_02"></div>';
            loading += '<div class="blockG" id="rotateG_03"></div>';
            loading += '<div class="blockG" id="rotateG_04"></div>';
            loading += '<div class="blockG" id="rotateG_05"></div>';
            loading += '<div class="blockG" id="rotateG_06"></div>';
            loading += '<div class="blockG" id="rotateG_07"></div>';
            loading += '<div class="blockG" id="rotateG_08"></div>';
            loading += '</div>';
            $('body').append(loading);
        },
        complete: function () {
            //уничтожаем прилоадер
            $('#floatingBarsG').detach();
        }
    });