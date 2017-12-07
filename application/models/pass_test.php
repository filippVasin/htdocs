 <?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_pass_test{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }


    // Начинаем прохождение тестирования;
    public function start(){
        global $db, $elements;

//        print_r($_SESSION);
//        echo "<br>";
        $write_doc = $this->post_array['write_doc'];
        $go_to_testing = $this->post_array['go_to_testing'];
        $step_content_id="";
        $test_id="";
        $doc_id="";
        $form_id="";

        $result_array['status'] = 'next_step';
        if(isset($_SESSION['step_id'])) {


//    $_SESSION['step_id'] = 37;
            // получаем контент по шагу
            $sql = "SELECT route_control_step.step_content_id, periodicity, ManualHistory.ManualFinish, ManualHistory.finish_data,
                CASE
                  WHEN ManualHistory.ManualFinish IS NULL OR (
    				periodicity is not NULL AND  now() >=  (ManualHistory.finish_data + INTERVAL periodicity MONTH)
   				)
                  THEN step_content.manual_id
                  ELSE NULL
                  END AS ManualActual,

           		CASE
                  WHEN DocHistory.DocFinish IS NULL OR (
    				periodicity is not NULL AND  now() >=  (DocHistory.finish_data + INTERVAL periodicity MONTH)
   				)

                  THEN step_content.test_id
                  ELSE NULL
                  END AS TestActual,

                CASE
                  WHEN DocHistory.DocFinish IS NULL OR (
    				periodicity is not NULL AND  now() >=  (DocHistory.finish_data + INTERVAL periodicity MONTH)
   				)
                  THEN step_content.doc_id
                  ELSE NULL
                  END AS DocActual,

                CASE
                  WHEN FormHistory.FormFinish IS NULL OR (
    				periodicity is not NULL AND  now() >=  (FormHistory.finish_data + INTERVAL periodicity MONTH)
   				)


                  THEN step_content.form_id
                  ELSE NULL
                  END AS FormActual

              FROM
                route_control_step
                LEFT JOIN step_content
                ON step_content.id = route_control_step.step_content_id
                 LEFT JOIN
                    (SELECT manual_history.step_id AS ManualFinish, manual_history.date_finish AS finish_data
                      FROM
                        manual_history, route_control_step
                      WHERE
                        manual_history.step_id = " . $_SESSION['step_id'] . "
                        AND
                        manual_history.employee_id = " . $_SESSION['employee_id'] . "
                        AND
                        manual_history.date_finish IS NOT NULL

                        GROUP BY ManualFinish) AS ManualHistory
                    ON ManualHistory.ManualFinish = route_control_step.id

            	 LEFT JOIN
                    (SELECT history_docs.step_id AS DocFinish, history_docs.date_finish AS finish_data
                      FROM
                        history_docs
                      WHERE
                        history_docs.step_id = " . $_SESSION['step_id'] . "
                        AND
                        history_docs.employee_id = " . $_SESSION['employee_id'] . "
                        AND
                        history_docs.date_finish IS NOT NULL  GROUP BY DocFinish) AS DocHistory
                      ON DocHistory.DocFinish = route_control_step.id


                    LEFT JOIN
                      (SELECT pass_test_form_history.step_id AS FormFinish, pass_test_form_history.data_finish AS finish_data
                        FROM
                          pass_test_form_history
                        WHERE
                          pass_test_form_history.step_id = " . $_SESSION['step_id'] . "
                          AND
                          pass_test_form_history.employee = " . $_SESSION['employee_id'] . "
                          AND
                          pass_test_form_history.data_finish IS NOT NULL GROUP BY FormFinish) AS FormHistory
                    ON FormHistory.FormFinish = route_control_step.id
WHERE route_control_step.id =" . $_SESSION['step_id'];
// echo $sql;
            $condition_test = $db->row($sql);
//    echo $sql;
            // получаем данные:
            if (isset($condition_test['step_content_id'])) {
                $step_content_id = $condition_test['step_content_id'];
            }
            if (isset($condition_test['TestActual'])) {
                $test_id = $condition_test['TestActual'];
            }
            if (isset($condition_test['DocActual'])) {
                $doc_id = $condition_test['DocActual'];
            }
            if (isset($condition_test['FormActual'])) {
                $form_id = $condition_test['FormActual'];
            }
            if (isset($condition_test['ManualActual'])) {
                $manual_id = $condition_test['ManualActual'];
            }

            // тесты прошли, а доки нет
            if (isset($manual_id)) {
                $result_array['status'] = 'manual';
            } else {

                if (($form_id != "") && ($test_id == "") && ($doc_id == "")) {

                    $_SESSION['form_id'] = $form_id;
                    $result_array['status'] = 'form';
//            header("Location:/rover" );// уходим на новый круг
                }

                // тесты и доки прошли
                if (($form_id == "") && ($test_id == "") && ($doc_id == "")) {

                    $sql = "SELECT *
                        FROM history_docs
                        WHERE history_docs.employee_id = " . $_SESSION['employee_id'] . "
                        AND history_docs.step_id =" . $_SESSION['step_id'];
                    $history_check = $db->row($sql);
                    if (isset($history_check['id'])) {
                        // уже есть запись
                    } else {
                        // так и не было записи незабыли записать в хистори_степ
                        $sql = "INSERT INTO `history_docs` (`employee_id`, `step_id`, `date_start`,`date_finish`) VALUES('" . $_SESSION['employee_id'] . "', '" . $_SESSION['step_id'] . "', NOW(), NOW());";
                        $db->query($sql);
                    }


                    $sql = "INSERT INTO `history_step` (`employee_id`, `step_id`,`data_finish`) VALUES('" . $_SESSION['employee_id'] . "', '" . $_SESSION['step_id'] . "', NOW());";
                    $db->query($sql);
                    $this->session_clear();
                    $result_array['status'] = 'next_step';
                }


                // тесты не проходили
                if (($test_id != "") || ($doc_id != "")) {
                    // получаем флаги проходжения док/тест

                    $result_array['open'] = "";
                    // если теста нет а документ пройден пишим в базу конец-шага
                    if (($go_to_testing == 1) && ($_SESSION['test_id'] == NULL)) {

                        $sql = "UPDATE `history_docs` SET `date_finish`= NOW() WHERE  `employee_id`='" . $_SESSION['employee_id'] . "' AND `step_id`='" . $_SESSION['step_id'] . "'";
                        $db->query($sql);

                        $result_array['content'] = '';
                        $result_array['status'] = 'not test';// флаг для view - перейти на следующий щаг
                        $result = json_encode($result_array, true);

                        die($result);// ответ view
                    }

                    // записываем начало прохождения док
                    $sql = "INSERT INTO `history_docs` (`employee_id`, `step_id`, `date_start`) VALUES('" . $_SESSION['employee_id'] . "', '" . $_SESSION['step_id'] . "', NOW());";
                    $db->query($sql);
//            echo $sql;

                    // запрашиваемм данные по шагу(док/тест названия/пути)
                    $sql = "SELECT step_content.test_id , step_content.doc_id ,
                control_doc.read_doc, control_doc.doc_name,
                control_tests.test_name
                FROM step_content
                LEFT JOIN control_doc
                ON control_doc.id = step_content.doc_id
                LEFT JOIN control_tests
                ON control_tests.id = step_content.test_id
                WHERE step_content.id = '" . $step_content_id . "';";
                    $test_data = $db->row($sql);

                    $test_id = $test_data['test_id'];
                    $_SESSION['test_id'] = $test_id;
                    $_SESSION['test_name'] = $test_data['test_name'];
                    $read_doc = $test_data['read_doc'];
                    $doc_name = $test_data['doc_name'];
//                echo '"'.$doc_name .'"'." " .'"'. $read_doc .'"';
                    // если есть документ и мы его не читали
                    if ($read_doc != '' && ($write_doc == 0)) {
//                    echo $url_file = ROOT_PATH . '/application/test_docs/' . $read_doc;
                        $result = file_get_contents(ROOT_PATH . '/application/test_docs/' . $read_doc);
//                    echo $result . " тут";
                        // правим пути к рисункам
                        $img_link = 'SRC="/application/test_docs/';
                        $result = str_replace('SRC="', $img_link, $result);
                        // Создали кнопку
                        $result .= $elements->button('Ознакомлен', 'go_to_testing', '', '', '', 'test_id ="' . $test_id . '"');
                        // информационный блок
                        // прогресс бар с количеством вопросов($need_count);
                        $result .= '<div id="progress_box">
                                    <div id="progress_box_cell">
                                    <table id="table_test" class="table table-condensed" >
                                    <tbody>
                                    <tr>
                                      <td>Вы читаете:</td>
                                      <td id="inst_name_doc">'. $doc_name .'</td>
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
//           $result = mb_convert_encoding($result, 'utf-8', 'cp1251');

                        $result_array['message'] = 'Сначала ознакомитесь с содержанием представленного документа, а затем начнется тестирование.';

                    } else {
                        // Если текст для прочтения нет - начинаем тестирование;
                        $result = $this->test_try($test_id, $test_data['test_name']);

                        $result_array['message'] = 'Тестирование началось. В каждом из представленных вопросов, вам нужно выбрать один из вариантов.';
                    }
                    $result_array['content'] = $result;
                    $result_array['status'] = 'ok';

                }
            }
        }
            $result = json_encode($result_array, true);
            die($result);

    }
    // отчистка сессии
    private function session_clear(){
        unset($_SESSION['test_id']);
        unset($_SESSION['step_id']);
        unset($_SESSION['test_name']);
        unset($_SESSION['form_id']);
    }



    // Приватный метод начала тестирования;
    private function test_try($test_id, $test_name){
        global $db, $elements;

        $result = '<div id="test" test_id="'.$test_id.'">';


        // Название теста;
        $result .= '<div class="page_title"></div>';

        // Поулчаем списко вопросов;
        $sql = "SELECT * FROM `control_tests_questions` WHERE `test_id` = '".$test_id."';";
//        echo $sql;
        $questions = $db->all($sql);
        $questions_id_array = array();

        foreach($questions as $question){
//            echo $question['id'];
            $questions_id_array[] = $question['id'];
        }

        // УЗнаем, сколько нам надо показать пользователю вопросов;
        $sql = "SELECT `questions_count` FROM `control_tests` WHERE `id` = '".$test_id."';";
        $need_count = $db->one($sql);
        // Если задано какое-то число;


        if($need_count != 0){
            // Получаем все ID вопросов;
            $keys = array_rand($questions_id_array,$need_count);

            foreach ($keys as $key=>$value) {
                $questions_id_array[$key] = $questions_id_array[$value];
            }
        }

        // Получаем список ответов;


        $sql = "SELECT * FROM `control_tests_answers` WHERE `question_id` IN (".implode(',', $questions_id_array).");";
//        echo $sql;
        $answers_array = $db->all($sql);
        $answers = array();

        // Немного переработает массив с вариантами ответов;
        foreach($answers_array as $answer_item){
            $answers[$answer_item['question_id']][] =
                array(
                    'answer_id' => $answer_item['id'],
                    'answer_text' => $answer_item['answer_text']
                );
        }
        // После формирования массива с вариантами ответов, формируем список вопросов;
        foreach($questions as $question){
            // Исключаем вопросы которые мы могли ограничить;
            if(!in_array($question['id'], $questions_id_array)){
                continue;
            }

            $result .= '<div class="test_question" question_id="'.$question['id'].'">';
            $result .= '<b>'.$question['question_text'].'</b>';


            foreach($answers as $question_id => $answer_array){
                if($question['id'] == $question_id){
                    foreach($answer_array as $answer){
                        $result .= '<div class="test_answer unselected_answer" answer_id="'.$answer['answer_id'].'">';
                        $result .= $answer['answer_text'];
                        $result .= '</div>';
                    }
                }
            }

            $result .= '</div>';
        }
        global $test_name_box;
        // информационный блок
        $result .= '<div id="progress_box">
                            <div id="progress_box_cell">
                            <table class="table table-condensed" >
                            <tbody>
                            <tr>
                              <td>Тестированние:</td>
                              <td>'. $_SESSION['test_name'] .'</td>
                              <td>'. $_SESSION['employee_id'] .'</td>
                              <td> '.  $_SESSION['$employee_full_name'] .' </td>
                            </tr>';
        // прогресс бар с количеством вопросов($need_count)
        $result .= $elements->progress_bar($need_count);
        // навигация
        $result .= '<a class="btn btn-app up" id="up">
                                Вверх <i class="fa fa-sort-up"></i>
                              </a>

                               <a class="btn btn-app down" id="down">
                                <i class="fa fa-sort-desc"></i> Вниз
                              </a>
                                </div>
                              </div>';
        // Снопка для завершения тестированияж
        $result .= $elements->button('Проверить ответы', 'finish_test');
//        $result .= $elements->button('Вернуться к инструкции', 'close_test');


        $result .= '</div>';



        return $result;

    }

    // Обработка результатов тестирования;
    public function processing_results(){
        global $db;

        // Получаем результат;
        $result_array = json_decode($this->post_array['test_result'], true);
        $result_array = $result_array[0];

        // Начинаем его сверять ответы с правильными;
        $test_id = $result_array['test_id'];

        // Получаем ID попытки;
//        $sql = "SELECT `id` FROM `start_step_history` WHERE `step_id` = '".$_SESSION['step_id']."' ORDER BY `start_date` DESC LIMIT 1;";
//        $try_id = $db->one($sql);
//        echo $sql;
        // Ответы;
        $result_answers = $result_array['answers'];

        // Счет правильных ответов;
        $right_answers = 0;

        foreach($result_answers as $answer_id){
            // ПРоверяем, был ли этот ответ правильным;
            $sql = "SELECT `right` FROM `control_tests_answers` WHERE `id` = '".$answer_id."';";
            $right = $db->one($sql);

            if($right == 1){
                $right_answers++;
            }

            // Записываем таблицу в базу информацию о сделанных ответах;
//            if(){
//
//            }
            $sql = "INSERT INTO `control_tests_questions_results` (`answer_id`, `date`) VALUES( '".$answer_id."', NOW());";
            $db->query($sql);
        }

        // Сколько нужно правильных ответов для теста?;
        $sql = "SELECT `questions_need_for_finish` FROM `control_tests` WHERE `id` = '".$test_id."';";
        $need_right_answers = $db->one($sql);

        // Если правильных ответов большие или столько же сколько нужно для прохождения теста - закрываем тестирование;
        if($right_answers >= $need_right_answers){
            // Закрываем попытку;
            // прошли тест - записываем step-end
            $sql = "UPDATE `history_docs` SET `date_finish`= NOW() WHERE  `employee_id`='" .  $_SESSION['employee_id'] . "' AND `step_id`='".$_SESSION['step_id'] ."'";
            $db->query($sql);
            $result_array['open'] = 'open_test';
            $result_array['message'] = 'Поздравляем! Вы успешно прошли тестирование ответив правильно на '.$right_answers.' из '.count($result_answers);
            $result_array['status'] = 'ok';
        }   else{
            $result_array['message'] = 'К сожалению вы не прошли тестирование. Вы не набрали минимальное количество правильных вопросов. Повторите попытку позже';
            $result_array['status'] = 'error';
        }

        $result = json_encode($result_array, true);
        die($result);
    }
}