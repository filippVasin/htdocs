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
    <?
    // Здесь мы будем выводить блок в js переданные нам viewer;
    if(isset($viewer_js) && $viewer_js != ''){
        echo $viewer_js;
    }
    ?>
</head>
<body>
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

<div id="body">
    <?
        // Здесь мы будем выводит отображение которое передал нам маршрутизатор;
        if(isset($inside_viewer) && $inside_viewer != ''){
            echo $inside_viewer;
        }
    ?>
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

<!--    <div style="margin: 10px;"><img src="/templates/--><?//echo $current_template;?><!--/images/icon_core.png" alt="logo"></div>-->
</div>

</body>
</html>