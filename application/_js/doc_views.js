$(document).ready(function() {
    var printing_css='<style media="print">@media print { .header-left-top, .a-right-bottom, .time-right-bottom { color: #fff;}}</style>';
    var html_to_print=printing_css+$('div.Section1').html();

    var iframe=$('<iframe id="print_frame">');
    $('body').append(iframe);

    var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
    var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];

    doc.getElementsByTagName('body')[0].innerHTML=html_to_print;



    $(document).on("click", "#print", function () {
        win.print();
    });

    setTimeout(document.getElementById("print").click(), 1000);
});


