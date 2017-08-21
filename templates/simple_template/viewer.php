<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Labor Protection</title>
    <link rel="icon" type="/image/png" href="/templates/<?echo $current_template;?>/images/icon_core.png" />
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/templates/<?echo $current_template;?>/css/preloader.css" type="text/css" />
    <script type="application/javascript" src="/templates/<?echo $current_template;?>/js/jquery.js"></script>
    <script type="application/javascript" src="/templates/<?echo $current_template;?>/js/functions.js"></script>
    <script type="application/javascript" src="/templates/<?echo $current_template;?>/js/jquery.maskedinput.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/templates/<?echo $current_template;?>/css/tcal.css" />
    <script type="text/javascript" src="/templates/<?echo $current_template;?>/js/tcal.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?
    // Здесь мы будем выводить блок в js переданные нам viewer;
    if(isset($viewer_js) && $viewer_js != ''){
        echo $viewer_js;
    }
    ?>
</head>
<body>
<div id="topBar">
    <div class="left transform">
        <div class="logo">LP</div>
        <? if($_SESSION['role_id'] == 3){

        } else {
           echo  '<div id="menu_open" class="mune_icon transform"><img src="../../templates/simple_template/images/menu_icon.svg"></div>';
        } ?>

    </div>
    <? if(isset($_SESSION['user_id'])){
       echo '<a href="/exit" class="dors_button"><div>Выход</div><img src="../../templates/simple_template/images/exit_icon.svg"></a>';
     } else {
        echo '<a href="/login" class="dors_button"><div>Войти</div><img src="../../templates/simple_template/images/reset_icon.svg"></a>';
    }?>
</div>

<div id="header">
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

<div id="body" class="gray">
    <?
        // Здесь мы будем выводит отображение которое передал нам маршрутизатор;
        if(isset($inside_viewer) && $inside_viewer != ''){
            echo $inside_viewer;
        }
    ?>
</div>



<!--    <div style="margin: 10px;"><img src="/templates/--><?//echo $current_template;?><!--/images/icon_core.png" alt="logo"></div>-->
</div>

<div id="bottom">
    <div id="message"></div>

    <div id="preloader">
        <div class="cssload-container">
            <div class="cssload-bouncywrap">
                <div class="cssload-cssload-dotcon cssload-dc1">
                    <div class="cssload-dot"></div>
                </div>
                <div class="cssload-cssload-dotcon dc2">
                    <div class="cssload-dot"></div>
                </div>
                <div class="cssload-cssload-dotcon dc3">
                    <div class="cssload-dot"></div>
                </div>
            </div>
        </div>
        <div id="preloader_text"></div>
    </div>
<script>
    $(document).ready(function() {
        $(document).on("click", "#menu_open", function () {

            if($("#header div").hasClass("display_none")){
                $("#header>a").removeClass('attr');

                $("#topBar .logo").css("width", "220px");
                $("#header>a").css("width", "220px");
                $("#header>a").css("padding-left", "10px");
                $("#header>a>img").css("height", "20px");


                setTimeout(function() { $("#header div").removeClass("display_none")}, 350);
                setTimeout(function() { $("#topBar .logo").html('LabroPro') }, 350);

            } else {
                $("#header>a").addClass('attr');
                $("#header div").addClass("display_none");
                $("#topBar .logo").html('LP');

                $("#topBar .logo").css("width", "50px");
                $("#header>a").css("width", "50px");
                $("#header>a").css("padding-left", "0px");
                $("#header>a>img").css("height", "30px");

            }

        });
    });
</script>
</body>
</html>