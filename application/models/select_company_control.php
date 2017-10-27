<?php

class Model_select_company_control{
    // Данные для обработки POST запросов;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function get_company(){
            if(!(isset($_SESSION['user_id']))){
                header("Location:/login");
            }
            global $db;

            $html = '';

            $sql = "SELECT company.id, company.name, company.short_name, company.director_surname, company.director_name, company.director_second_name
                    FROM observer_company,company
                    WHERE observer_company.company_id != 0
                    AND company.id = observer_company.company_id
                    AND observer_company.observer_user_id = ".$_SESSION['user_id'].";";
            $company_array = $db->all($sql);
            foreach($company_array as $company_item){

                $sql = "SELECT company.name AS company_name,  company.name AS company_short_name
                    FROM organization_structure,company
                    WHERE organization_structure.items_control_id = 10
                    AND organization_structure.left_key != 1
                    AND organization_structure.company_id = ". $company_item['id'] ."
                    AND organization_structure.company_id = company.id";
                $company_items = $db->all($sql);
                $html_tems = "<br><div>Состав группы компаний:</div><br>";
                $count = 0;
                foreach($company_items as $key=>$company_it){
                    $html_tems .= '<div class="company_name">'. $company_it['company_name'] .' ('.$company_it['company_short_name'].')</div>';
                    ++$count;
                }
                if($count == 0){
                    $html_tems = "";
                }

                $html .= '<div class="list_item" id="company_'.$company_item['id'].' " style="" company_id="'.$company_item['id'].' "><div style="vertical-align: middle;">
                    <div class="button company_turn_control '. ($company_item['id'] == $_SESSION['control_company'] ? 'on_company' : 'off_company') .'" id="" style="margin-right: 10px;margin-top: 5px;">Включить управление</div>
                    </div>
                    <div style="vertical-align: middle;">'. $company_item['name'] .' ('.$company_item['short_name'].') / '.$company_item['director_surname'].' '.$company_item['director_name'].' '.$company_item['director_second_name'].' </div>
                    '. $html_tems .'</div>';


            }

        return $html;
    }




    public function start_company_control(){
        global $db;

        $post_data = $this->post_array;
        $company_id = $post_data['company_id'];

        $sql = "SELECT * FROM `company` WHERE `id` = '".$company_id."';";
        $company_data = $db->row($sql);

        $_SESSION['control_company'] = $company_id;
        $_SESSION['control_company_name'] = $company_data['short_name'];

        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }
}