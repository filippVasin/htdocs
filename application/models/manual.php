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
//        echo $sql;
        $db->query($sql);
//        print_r($_SESSION);
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
            $img_link = 'src="/application/manual_docs/';
            $result = str_replace('src="', $img_link, $result);
            // Создали кнопку
            $result .= $elements->button('Ок', 'go_to_testing', '', '', '', '');
            // информационный блок
//            $result .= $elements->info_box("Вы читаете:", $name, $_SESSION['employee_id'], $_SESSION['$employee_full_name']);
            // прогресс бар с количеством вопросов($need_count);
            $result .= '<div id="progress_box">
                            <div id="progress_box_cell">
                            <table class="table table-condensed" >
                            <tbody>
                            <tr>
                              <td>Вы читаете:</td>
                              <td>'. $name .'</td>
                              <td>'. $_SESSION['employee_id'] .'</td>
                              <td> '.  $_SESSION['$employee_full_name'] .' </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar progress-bar-primary progress_bar_line_back" style="width: 0%"></div>
                                </div>
                              </td>
                              <td>
                                <span class="badge bg-light-blue progress_line_proc">0%</span>
                              </td>

                            </tr>
                          </tbody></table>

                          <a class="btn btn-app up" id="up">
                                Вверх <i class="fa fa-sort-up"></i>
                              </a>

                               <a class="btn btn-app down" id="down">
                                <i class="fa fa-sort-desc"></i> Вниз
                              </a>
                                </div>
                              </div>';
            // навигация
//            $result .= $elements->nav_button('Вверх', 'up');
//            $result .= $elements->nav_button('Вниз', 'down');

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
//        echo $sql;
        $db->query($sql);
        $result_array['status'] = 'yes';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function error(){
        //  здесь надо добавить запись в лог ошибок

        $result_array['status'] = 'error';
        // Отправили зезультат
        return json_encode($result_array);
    }


}