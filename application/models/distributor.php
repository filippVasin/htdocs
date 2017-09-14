<?php

class Model_distributor{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }


    // Начинаем прохождение тестирования;
    public function main(){
        global $db;
        $action_name = $this->post_array['action_name'];

        switch ($action_name) {
            case "secretary_signature_alert":
                $result_array = $this->secretary_signature_action();
                break;
            case "secretary_get_doc_action":
                $result_array = $this->secretary_get_doc_action();
                break;
            case "bailee_action":
                $result_array = $this->bailee_action();
                break;
        }



        $result_array['content'] = $_SESSION['employee_id'];
        $result_array['status'] = 'ok';
        //
        $result = json_encode($result_array, true);
        die($result);
    }




    private function secretary_signature_action(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 11;// документ подписал

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `id`=" . $local_id;
        $db->query($sql);

        $sql="SELECT form_status_now.track_form_step_now, form_status_now.track_number_form_id,temps_form_step.son_step
                FROM form_status_now,temps_form_step
                WHERE temps_form_step.id = form_status_now.track_form_step_now
                AND form_status_now.save_temps_file_id =". $la_real_form_id;
        $form_content = $db->row($sql);
        $son_step = $form_content['son_step'];// зашни на дочерний шаг
        $track = $form_content['track_number_form_id'];



        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $track ."','".  $son_step ."',NOW(),NOW(),'". $observer_em ."','". $doc_status ."');";

        $db->query($sql);

        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $la_real_form_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $insert_history ."','". $track ."','". $son_step  ."','". $observer_em ."','". $doc_status ."');";
        $db->query($sql);

        $result_array['la_real_form_id'] = $la_real_form_id;
        $result_array['observer_em'] = $observer_em;
        $result_array['la_employee'] = $la_employee;
        $result_array['form_actoin'] = "la_signature";
        $result_array['page'] = "local_alert";
        return $result_array;
    }


    private function secretary_get_doc_action(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 13;// Секретарь получил документ

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `id`=" . $local_id;
        $db->query($sql);

        $sql="SELECT form_status_now.track_form_step_now, form_status_now.track_number_form_id,temps_form_step.son_step
                FROM form_status_now,temps_form_step
                WHERE temps_form_step.id = form_status_now.track_form_step_now
                AND form_status_now.save_temps_file_id =". $la_real_form_id;
        $form_content = $db->row($sql);
        $son_step = $form_content['son_step'];// зашни на дочерний шаг
        $track = $form_content['track_number_form_id'];



        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $track ."','".  $son_step ."',NOW(),NOW(),'". $observer_em ."','". $doc_status ."');";

        $db->query($sql);

        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $la_real_form_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $insert_history ."','". $track ."','". $son_step  ."','". $observer_em ."','". $doc_status ."');";
        $db->query($sql);

        $result_array['la_real_form_id'] = $la_real_form_id;
        $result_array['observer_em'] = $observer_em;
        $result_array['la_employee'] = $la_employee;
        $result_array['form_actoin'] = "secretary_accept_alert";
        $result_array['page'] = "local_alert";
        return $result_array;
    }


    private function bailee_action(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 16;// документ подписал ответственный

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `id`=" . $local_id;
        $db->query($sql);

        $sql="SELECT form_status_now.track_form_step_now, form_status_now.track_number_form_id,temps_form_step.son_step
                FROM form_status_now,temps_form_step
                WHERE temps_form_step.id = form_status_now.track_form_step_now
                AND form_status_now.save_temps_file_id =". $la_real_form_id;
        $form_content = $db->row($sql);
        $son_step = $form_content['son_step'];// зашни на дочерний шаг
        $track = $form_content['track_number_form_id'];



        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $track ."','".  $son_step ."',NOW(),NOW(),'". $observer_em ."','". $doc_status ."');";

        $db->query($sql);

        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $la_real_form_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $insert_history ."','". $track ."','". $son_step  ."','". $observer_em ."','". $doc_status ."');";
        $db->query($sql);

        $result_array['la_real_form_id'] = $la_real_form_id;
        $result_array['observer_em'] = $observer_em;
        $result_array['la_employee'] = $la_employee;
        $result_array['form_actoin'] = "la_signature";
        $result_array['page'] = "local_alert";
        return $result_array;
    }

}