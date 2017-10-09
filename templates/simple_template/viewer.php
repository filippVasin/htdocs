<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="height: auto; min-height: 100%;">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Labor Protection</title>
    <link rel="icon" type="/image/png" href="/templates/<?echo $current_template;?>/images/icon_core.png" />
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/css/style.css" type="text/css" />



    <script type="application/javascript" src="/templates/<?echo $current_template;?>/js/jquery.js"></script>


<!--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->

    <!--адиптив-->
<!--    $_SERVER['REQUEST_URI']!= "/local_alert"-->
    <?
//        if(($_SERVER['REQUEST_URI']!= "/local_alert")  && ($_SERVER['REQUEST_URI']!= "/docs_report")){
            echo '<meta id="meta" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
//        }
    ?>


    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



    <style type="text/css">
        #p_prldr{
            position: fixed;
            left: 0;
            top: 0;
            right:0;
            bottom:0;
            background: #3c8dbc;
            z-index: 30;}

        .contpre small{font-size:25px;}

        .contpre{
            width: 250px;
            height: 100px;
            position: absolute;
            left: 50%;top: 48%;
            margin-left:-125px;
            margin-top:-75px;
            color:#fff;
            font-size:40px;
            letter-spacing:-2px;
            text-align:center;
            line-height:35px;}
        #p_prldr .svg_anm {
            position: absolute;
            width: 41px;
            height: 41px;
            /*background: url('./templates/simple_template/images/loading_apple-Small2.gif') center center no-repeat;*/
            background-size:41px;
            margin: -16px 0 0 -16px;}


        .cssload-thecube {
            width: 73px;
            height: 73px;
            margin: 0 auto;
            margin-top: 49px;
            position: relative;
            transform: rotateZ(45deg);
            -o-transform: rotateZ(45deg);
            -ms-transform: rotateZ(45deg);
            -webkit-transform: rotateZ(45deg);
            -moz-transform: rotateZ(45deg);
        }
        .cssload-thecube .cssload-cube {
            position: relative;
            transform: rotateZ(45deg);
            -o-transform: rotateZ(45deg);
            -ms-transform: rotateZ(45deg);
            -webkit-transform: rotateZ(45deg);
            -moz-transform: rotateZ(45deg);
        }
        .cssload-thecube .cssload-cube {
            float: left;
            width: 50%;
            height: 50%;
            position: relative;
            transform: scale(1.1);
            -o-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
        }
        .cssload-thecube .cssload-cube:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(194,192,214);
            animation: cssload-fold-thecube 2.76s infinite linear both;
            -o-animation: cssload-fold-thecube 2.76s infinite linear both;
            -ms-animation: cssload-fold-thecube 2.76s infinite linear both;
            -webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
            -moz-animation: cssload-fold-thecube 2.76s infinite linear both;
            transform-origin: 100% 100%;
            -o-transform-origin: 100% 100%;
            -ms-transform-origin: 100% 100%;
            -webkit-transform-origin: 100% 100%;
            -moz-transform-origin: 100% 100%;
        }
        .cssload-thecube .cssload-c2 {
            transform: scale(1.1) rotateZ(90deg);
            -o-transform: scale(1.1) rotateZ(90deg);
            -ms-transform: scale(1.1) rotateZ(90deg);
            -webkit-transform: scale(1.1) rotateZ(90deg);
            -moz-transform: scale(1.1) rotateZ(90deg);
        }
        .cssload-thecube .cssload-c3 {
            transform: scale(1.1) rotateZ(180deg);
            -o-transform: scale(1.1) rotateZ(180deg);
            -ms-transform: scale(1.1) rotateZ(180deg);
            -webkit-transform: scale(1.1) rotateZ(180deg);
            -moz-transform: scale(1.1) rotateZ(180deg);
        }
        .cssload-thecube .cssload-c4 {
            transform: scale(1.1) rotateZ(270deg);
            -o-transform: scale(1.1) rotateZ(270deg);
            -ms-transform: scale(1.1) rotateZ(270deg);
            -webkit-transform: scale(1.1) rotateZ(270deg);
            -moz-transform: scale(1.1) rotateZ(270deg);
        }
        .cssload-thecube .cssload-c2:before {
            animation-delay: 0.35s;
            -o-animation-delay: 0.35s;
            -ms-animation-delay: 0.35s;
            -webkit-animation-delay: 0.35s;
            -moz-animation-delay: 0.35s;
        }
        .cssload-thecube .cssload-c3:before {
            animation-delay: 0.69s;
            -o-animation-delay: 0.69s;
            -ms-animation-delay: 0.69s;
            -webkit-animation-delay: 0.69s;
            -moz-animation-delay: 0.69s;
        }
        .cssload-thecube .cssload-c4:before {
            animation-delay: 1.04s;
            -o-animation-delay: 1.04s;
            -ms-animation-delay: 1.04s;
            -webkit-animation-delay: 1.04s;
            -moz-animation-delay: 1.04s;
        }



        @keyframes cssload-fold-thecube {
            0%, 10% {
                transform: perspective(136px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                transform: perspective(136px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                transform: perspective(136px) rotateY(180deg);
                opacity: 0;
            }
        }

        @-o-keyframes cssload-fold-thecube {
            0%, 10% {
                -o-transform: perspective(136px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                -o-transform: perspective(136px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                -o-transform: perspective(136px) rotateY(180deg);
                opacity: 0;
            }
        }

        @-ms-keyframes cssload-fold-thecube {
            0%, 10% {
                -ms-transform: perspective(136px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                -ms-transform: perspective(136px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                -ms-transform: perspective(136px) rotateY(180deg);
                opacity: 0;
            }
        }

        @-webkit-keyframes cssload-fold-thecube {
            0%, 10% {
                -webkit-transform: perspective(136px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                -webkit-transform: perspective(136px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                -webkit-transform: perspective(136px) rotateY(180deg);
                opacity: 0;
            }
        }

        @-moz-keyframes cssload-fold-thecube {
            0%, 10% {
                -moz-transform: perspective(136px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                -moz-transform: perspective(136px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                -moz-transform: perspective(136px) rotateY(180deg);
                opacity: 0;
            }
        }
    </style>

    <?
    // Здесь мы будем выводить блок в js переданные нам viewer;
    if(isset($viewer_js) && $viewer_js != ''){
        echo $viewer_js;
    }
    ?>
</head>

<body>

<!-- прилоадер:-->
<div id="p_prldr"><div class="contpre"><div class="cssload-thecube">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div><span class="logo-lg"><br><b>Labor</b>Pro</span><br><small>идет загрузка данных ...</small></div></div>
<!--<div class="vdox">-->
<!--<div id="video_box">-->
<!---->
<!--</div>-->
<!--    </div>-->

<div id="header" class="sidebar">
    <?
    // Здесь мы будем выводит меню которое передал нам маршрутизатор;
    if(isset($menu_viewer) && $menu_viewer != ''){
        echo $menu_viewer;
    }
    ?>
</div>

<?
if(isset($_SESSION['control_company_name'])){
    ?><div class="control_company"  <? if( $_SESSION['role_id'] == 3) {echo 'style="display: none"';}?> >Компания: <b><?echo $_SESSION['control_company_name'];?></b></div><?
}
?>

<div id="body" class="gray wrapper" style="height: auto; min-height: 100%;min-height: 906px;">
    <?
        // Здесь мы будем выводит отображение которое передал нам маршрутизатор;
        if(isset($inside_viewer) && $inside_viewer != ''){
            echo $inside_viewer;
        }
    ?>
</div>

<!--            Начало второй части-->
</div>
</section>
</section>

<!-- Main content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->

<!-- ./wrapper -->

<script>
//    $.widget.bridge('uibutton', $.ui.button);
</script>

<div class="daterangepicker dropdown-menu ltr opensleft"><div class="calendar left"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_start" value=""><i class="fa fa-calendar glyphicon glyphicon-calendar"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"></div></div><div class="calendar right"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_end" value=""><i class="fa fa-calendar glyphicon glyphicon-calendar"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"></div></div><div class="ranges"><ul><li data-range-key="Today">Today</li><li data-range-key="Yesterday">Yesterday</li><li data-range-key="Last 7 Days">Last 7 Days</li><li data-range-key="Last 30 Days">Last 30 Days</li><li data-range-key="This Month">This Month</li><li data-range-key="Last Month">Last Month</li><li data-range-key="Custom Range">Custom Range</li></ul><div class="range_inputs"><button class="applyBtn btn btn-sm btn-success" disabled="disabled" type="button">Apply</button> <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button></div></div></div><div class="jvectormap-label"></div></body>


<!--    <div style="margin: 10px;"><img src="/templates/--><?//echo $current_template;?><!--/images/icon_core.png" alt="logo"></div>-->
</div>



<div id="message_default" class="alert alert-info alert-dismissible none message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-info"></i> Привет!</h4>
    <span class="message_text"></span>
</div>


<div id="message_error" class="alert alert-danger alert-dismissible none message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Ошибка!</h4>
    <span class="message_text"></span>
</div>


<div id="message_info" class="alert alert-warning alert-dismissible none message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Внимание!</h4>
    <span class="message_text"></span>
</div>


<div id="message_ok" class="alert alert-success alert-dismissible none message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Ок!</h4>
    <span class="message_text"></span>
</div>

<script>
    $(document).ready(function() {


        if($(document).width() <= 480 ) {
            $("#header>a>img").addClass("none");
        }

        $(document).on("click", "#menu_open", function () {

            if($("#header div").hasClass("display_none")){
                $("#header>a").removeClass('attr');

                $("#topBar .logo").css("width", "220px");
                $("#header>a").css("width", "220px");
                $("#header>a").css("padding-left", "10px");
                $("#header>a>img").css("height", "20px");

                if($(document).width() <= 480 ) {
                    $(".page_title").addClass("none");
                    $("#header>a>img").removeClass("none");

                }
                setTimeout(function() { $("#header div").removeClass("display_none")}, 350);
                setTimeout(function() { $("#topBar .logo").html('LabroPro') }, 350);

            } else {
                $("#header>a").addClass('attr');
                $("#header div").addClass("display_none");
                $("#topBar .logo").html('LP');
                $(".page_title").removeClass("none");

                $("#header>a").css("padding-left", "0px");
                $("#header>a>img").css("height", "30px");

                if($(document).width() <= 480 ) {
                    $("#topBar .logo").css("width", "0px");
                    $("#header>a").css("width", "0px");
                    $("#header>a>img").addClass("none");
                } else {
                    $("#topBar .logo").css("width", "50px");
                    $("#header>a").css("width", "50px");
                }
            }

        });
    });
</script>
    <script>
        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function init_events(ele) {

                ele.each(function () {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex        : 1070,
                        revert        : true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })

                })
            }

            init_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()
            $('#calendar').fullCalendar({
                header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'Сегодня',
                    month: 'мес',
                    week : 'нед',
                    day  : 'день'
                },
                //Random default events
                events    : [
                    {
                        title          : 'Все события',
                        start          : new Date(y, m, 1),
                        backgroundColor: '#f56954', //red
                        borderColor    : '#f56954' //red
                    },
                    {
                        title          : 'Инструктажи',
                        start          : new Date(y, m, d - 5),
                        end            : new Date(y, m, d - 2),
                        backgroundColor: '#f39c12', //yellow
                        borderColor    : '#f39c12' //yellow
                    },
                    {
                        title          : 'Собрание',
                        start          : new Date(y, m, d, 10, 30),
                        allDay         : false,
                        backgroundColor: '#0073b7', //Blue
                        borderColor    : '#0073b7' //Blue
                    },

                    {
                        title          : 'Тренинги',
                        start          : new Date(y, m, d + 1, 19, 0),
                        end            : new Date(y, m, d + 1, 22, 30),
                        allDay         : false,
                        backgroundColor: '#00a65a', //Success (green)
                        borderColor    : '#00a65a' //Success (green)
                    },
                    {
                        title          : 'Отчёт за период',
                        start          : new Date(y, m, 28),
                        end            : new Date(y, m, 29),
                        url            : 'http://google.com/',
                        backgroundColor: '#3c8dbc', //Primary (light-blue)
                        borderColor    : '#3c8dbc' //Primary (light-blue)
                    }
                ],
                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject')

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject)

                    // assign it the date that was reported
                    copiedEventObject.start           = date
                    copiedEventObject.allDay          = allDay
                    copiedEventObject.backgroundColor = $(this).css('background-color')
                    copiedEventObject.borderColor     = $(this).css('border-color')

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove()
                    }

                }
            })

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            //Color chooser button
            var colorChooser = $('#color-chooser-btn')
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                //Save color
                currColor = $(this).css('color')
                //Add color effect to button
                $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
            })
            $('#add-new-event').click(function (e) {
                e.preventDefault()
                //Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                //Create events
                var event = $('<div/>');
                event.css({
                    'background-color': currColor,
                    'border-color'    : currColor,
                    'color'           : '#fff'
                }).addClass('external-event')
                event.html(val)
                $('#external-events').prepend(event)

                //Add draggable funtionality
                init_events(event)

                //Remove event from text input
                $('#new-event').val('')
            })
            $('#calendar').fullCalendar('option', 'locale', "ru");
        })
    </script>


<script type="application/javascript" src="/templates/<?echo $current_template;?>/js/functions.js"></script>
<script type="application/javascript" src="/templates/<?echo $current_template;?>/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="/templates/<?echo $current_template;?>/js/tcal.js"></script>

<script src="/templates/<?echo $current_template;?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/templates/<?echo $current_template;?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/templates/<?echo $current_template;?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>


<script src="/templates/<?echo $current_template;?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/templates/<?echo $current_template;?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/templates/<?echo $current_template;?>/bower_components/fastclick/lib/fastclick.js"></script>
<script src="/templates/<?echo $current_template;?>/dist/js/adminlte.min.js"></script>
<script src="/templates/<?echo $current_template;?>/dist/js/demo.js"></script>




    <script src="/templates/<?echo $current_template;?>/bower_components/jquery-ui/jquery-ui.min.js"></script>

    <script src="/templates/<?echo $current_template;?>/bower_components/moment/moment.js"></script>
    <script src="/templates/<?echo $current_template;?>/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

    <script src="/templates/<?echo $current_template;?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/templates/<?echo $current_template;?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/templates/<?echo $current_template;?>/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="/templates/<?echo $current_template;?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>


    <script src="/templates/<?echo $current_template;?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/templates/<?echo $current_template;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="/templates/<?echo $current_template;?>/dist/js/pages/dashboard.js"></script>
    <script src="/templates/<?echo $current_template;?>/bower_components/moment/locale/locale-all.js"></script>
    <script src="/templates/<?echo $current_template;?>/bower_components/moment/locale/ru.js"></script>
<script src="/templates/<?echo $current_template;?>/bower_components/bootstrap-daterangepicker/bootstrap-datepicker.ru.js" charset="UTF-8"></script>



<script src="/templates/<?echo $current_template;?>/bower_components/filter/dataTables.tableTools.js"></script>
<!--<script src="/templates/--><?//echo $current_template;?><!--/bower_components/filter/TableTools.ShowSelectedOnly.js"></script>-->
<!--<script src="/templates/--><?//echo $current_template;?><!--/bower_components/filter/range_dates.js"></script>-->
<!--<script src="/templates/--><?//echo $current_template;?><!--/bower_components/filter/range_numbers.js"></script>-->


<script type="text/javascript">
    $(document).on('click','.pril_start',function() {
        $("#p_prldr").css("display","block");
    });


    $(window).on('load', function () {
        var $preloader = $('#p_prldr'),
            $svg_anm   = $preloader.find('.svg_anm');
        $svg_anm.fadeOut();
        $preloader.delay(1500).fadeOut('slow');
    });

    $(document).ready(function() {
        $("li>a[href^='"+ window.location.pathname +"']").addClass("active_a");
        $(".content-wrapper").css("min-height",($(window).height() - 60));


    });



</script>


</body>
</html>