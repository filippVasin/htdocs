<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_documents_download{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

    // Строим список документов
    public function get_doc_list(){
        global $elements;

        $html = $elements->item_with_checkbox('Вводный инструктаж журнал', '', '', '', 'doc_name=induction_training_log');
        $html .= $elements->item_with_checkbox('Вводный инструктаж', '', '', '', 'doc_name=induction_training');
        $html .= $elements->item_with_checkbox('Должностная инструкция бухгалтера', '', '', '', 'doc_name=job_description_accountant_guide');
        $html .= $elements->item_with_checkbox('Инструкция по охране труда для работников офиса', '', '', '', 'doc_name=instruction_on_labor_protection_office');
        $html .= $elements->item_with_checkbox('Инструкция по оказанию первой помощи', '', '', '', 'doc_name=instructions_for_first_aid');

        return $html;
    }

    // Строим список сотрудников;
    public function get_employees_list(){
        global $db, $elements;

        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees_items_node.employe_id,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =".$_SESSION['control_company'];

        $employees = $db->all($sql);
//        print_r($employees);
        $html = '';

        if(count($employees) == 0){
            $html .= $elements->small_title('У вас нет сотрудников в управляемой компании. Добавите их и вернитесь в этот раздел.');
        }   else{
            foreach($employees as $employee){
                // Если сотрудник
                if($employee['fio'] !="") {
                    $array_erarh_id = array();
                    // формируем массив потомков
                    array_push($array_erarh_id, $employee['id']);
                    foreach ($employees as $employee_er) {
                        if (($employee['left_key'] >= $employee_er['left_key']) && ($employee['right_key'] <= $employee_er['right_key'])) {
                            array_push($array_erarh_id, $employee_er['id']);
                        }
                    }

                    // убрали повторения из массива
                    $array_erarh_id = array_unique($array_erarh_id);
                    // собираем ерархию потомков
                    foreach ($array_erarh_id as $key => $item) {
                        foreach ($employees as $employee_ar) {
                            if ($employee_ar['id'] == $item) {
//                              // собираем ассоциативный массив
                                $link[$employee_ar['level']] = [$employee_ar['erarh']];
                            }

                        }
                    }
                    // упорядочиваем по level
                    ksort($link);
                    // разобрали, накинули теги и собрали
                    $employee_new = "";
                    foreach ($link as $key=>$value) {
                        $values = explode(':', $value[0]);
                        $values[0] = '<b>' . $values[0] . ': </b>';
                        $employee_new .= $values[0] . $values[1] . '<b>; </b>';
                    }
                    // добавляем строку в выдачу
                    $html .= $elements->item_with_checkbox('ФИО: <b>' . $employee['fio'] . '</b><br>' . $employee_new, 'employee_' . $employee['id'], '', '', 'employee_id=' . $employee['employe_id']);


                }
            }
        }
        // отправляем на выход
        return $html;
    }

    // Загрузка документов;
    public function download(){
        global $db, $systems;

        $docs_array = json_decode($this->post_array['docs_array'], true);
        $employees_array = json_decode($this->post_array['employees_array'], true);

        $links = array();

        foreach($docs_array as $doc_item){
            // Ссылку нам вернет подключаемый шаблон;
            $doc_download_url = '';

            // Все глобальные переменные этого метода и $employees_array будут использоваться в подключеннмо файле документа;
            // Далее нам надо подключить щаблон файла который мы будем формировать;
            include(ROOT_PATH.'/application/down_docs/'.$doc_item.'.php');
            // Кладем ссылку в массив;
            $links[] = $doc_download_url;
        }

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Сейчас произойдет загрузка сформированного файла';
        $result_array['download_link'] = $links;

        // Отправили зезультат
        return json_encode($result_array);
    }
}