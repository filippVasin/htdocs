$(document).ready(function() {
    var printing_css='<style media="print">@page {size: landscape}</style>';
    var html_to_print=printing_css+$('div.Section1').html();

    var iframe=$('<iframe id="print_frame">'); // создаем iframe в переменную
    $('body').append(iframe); //добавляем эту переменную с iframe в наш body (в самый конец)

    var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
    var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];

    doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
    //$(iframe).remove();


    $(document).on("click", "#print", function () {
        win.print();
    });
});


