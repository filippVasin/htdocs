$(document).ready(function() {
    $(document).on('click','#test_report .items',function(){
        $("#test_circle").addClass('none');
        $("#test_report .items").addClass('none');
        $("#test_report .all").removeClass('none');
        $("#test_report .node_report").removeClass('none');
    });
    $(document).on('click','#test_report .all',function(){
        $("#test_circle").removeClass('none');
        $("#test_report .items").removeClass('none');
        $("#test_report .all").addClass('none');
        $("#test_report .node_report").addClass('none');
    });

    $(document).on('click','#emp_report .items',function(){
        $("#emp_circle").addClass('none');
        $("#emp_report .items").addClass('none');
        $("#emp_report .all").removeClass('none');
        $("#emp_report .node_report").removeClass('none');
    });
    $(document).on('click','#emp_report .all',function(){
        $("#emp_circle").removeClass('none');
        $("#emp_report .items").removeClass('none');
        $("#emp_report .all").addClass('none');
        $("#emp_report .node_report").addClass('none');
    });

    $(document).on('click','#doc_report .items',function(){
        $("#doc_circle").addClass('none');
        $("#doc_report .items").addClass('none');
        $("#doc_report .all").removeClass('none');
        $("#doc_report .node_report").removeClass('none');
    });
    $(document).on('click','#doc_report .all',function(){
        $("#doc_circle").removeClass('none');
        $("#doc_report .items").removeClass('none');
        $("#doc_report .all").addClass('none');
        $("#doc_report .node_report").addClass('none');
    });
});