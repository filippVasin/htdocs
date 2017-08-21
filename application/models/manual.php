<?php

class Model_manual
{
    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else()
    {
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }




    public function start()
    {
        global $db, $elements;
        $sql = "INSERT INTO `manual_history` (`employee_id`, `step_id`, `date_start`) VALUES('" . $_SESSION['employee_id'] . "', '" . $_SESSION['step_id'] . "', NOW());";
        $db->query($sql);
//        manual_docs
        $sql="SELECT manual_doc.id, manual_doc.`file`,manual_doc.name
                FROM route_control_step, step_content
                LEFT JOIN manual_doc
                ON manual_doc.id = step_content.manual_id
                WHERE step_content.id  = route_control_step.step_content_id
					 AND route_control_step.id=".$_SESSION['step_id'];
        $manual_data = $db->row($sql);
//         echo $sql;
        $file = $manual_data['file'];
        $name = $manual_data['name'];
        // сли док есть, показываем
        if ($file != "") {
            $result = file_get_contents(ROOT_PATH . '/application/manual_docs/' . $file);
            // правим пути к рисункам
            $img_link = 'SRC="/application/manual_docs/';
            $result = str_replace('SRC="', $img_link, $result);
            // Создали кнопку
            $result .= $elements->button('Ок', 'go_to_testing', '', '', '', '');
            // информационный блок
            $result .= $elements->info_box("Вы читаете:", $name, $_SESSION['employee_id'], $_SESSION['$employee_full_name']);
            // прогресс бар с количеством вопросов($need_count);
            $result .= $elements->progress_bar_line();
            // навигация
            $result .= $elements->nav_button('Вверх', 'up');
            $result .= $elements->nav_button('Вниз', 'down');

    } else {
        print_r($_SESSION);
        $result = "Документ не найден - ". $name ." ". $file . " Шаг - ". $_SESSION['step_id'] ;
        $result .= $elements->button('Ок', 'manual_error', '', '', '', '');
    }

        return $result;
    }

    public function yes(){
        global $db;
        $sql = "UPDATE `manual_history` SET `date_finish`= NOW() WHERE  `employee_id`='" .  $_SESSION['employee_id'] . "' AND `step_id`='".$_SESSION['step_id'] ."'";
        $db->query($sql);
        $result_array['status'] = 'yes';
        $result = json_encode($result_array, true);
        die($result);
    }

    public function error(){
        //  здесь надо добавить запись в лог ошибок

        $result_array['status'] = 'error';
        $result = json_encode($result_array, true);
        die($result);
    }


}