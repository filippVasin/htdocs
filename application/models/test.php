<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_test
{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

//    public function return_pass(){
//        global $db, $labro;
//
//        $sql = "SELECT * FROM users";
//        $pass_sql = $db->all($sql);
//
//        foreach ($pass_sql as $item) {
//            $pass = $labro->generate_password();
//            $sql = "INSERT INTO `temporary_links` (`id_user`, `pass`,`date_create`)
//                               VALUES('". $item['id'] ."', '". $pass ."',NOW());";
//            $db->query($sql);
//
//            $sql = "UPDATE `users` SET `password`= '". md5($pass) ."'  WHERE  `id`='".$item['id'] ."'";
//            $db->query($sql);
//        }
//    }
    public function info(){
        phpinfo();
    }



    // тестим здесь
    public function start(){


        $array = array('Alpha', 'atomic', 'Beta', 'bank');
        $array_lowercase = array_map('strtolower', $array);

        array_multisort($array_lowercase, SORT_ASC, SORT_STRING, $array);

        print_r($array);
    }

    private  function MoveNode($move_item,$new_parent,$company_id){
        global $db;

        // получаем ключи элемента
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $move_item;
                $result = $db->row($sql);
                $left_key = $result['left_key'];
                $right_key = $result['right_key'];
        // получаем ключи старого родителя
        $sql="SELECT organization_structure.parent, parent_org.left_key, parent_org.right_key
                FROM organization_structure
                LEFT JOIN organization_structure AS parent_org ON parent_org.id = organization_structure.parent
                WHERE organization_structure.id =".$move_item ;
                $result = $db->row($sql);
                $old_parent = $result['parent'];
                $old_parent_left_key = $result['left_key'];
                $old_parent_right_key = $result['right_key'];
        // получаем ключи нового родителя
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $new_parent;
                $result = $db->row($sql);
                $new_parent_left_key = $result['left_key'];
                $new_parent_right_key = $result['right_key'];
        if(($left_key<=$new_parent_left_key)&&($right_key>=$new_parent_right_key)){

                echo "нельзы переносить в самого себя";
        } else {


            // получаем раздницу по левелам
            $sql = "SELECT old_parent.`level` - new_parent.`level` AS level_delta
                FROM organization_structure AS new_parent, organization_structure AS old_parent
                WHERE new_parent.id = " . $new_parent . "
                AND old_parent.id = " . $old_parent;
            $result = $db->row($sql);
            $level_delta = $result['level_delta'];

            // Внешняя дельта - для применения к неперемещаемым узлам = количество перемещаемых ключей)))
            $external_delta = $right_key - $left_key + 1;

            // начинаем перемешение //
            // если идём вверх по ключам
            if ($old_parent_left_key < $new_parent_left_key) {
                // получили дельту для применения к внутренним перемещаемого элементам узла
                $new_right_key = $new_parent_right_key - 1;
                $delta = $new_right_key - $right_key;
                $new_left_key = $left_key + $delta;

                // поменяли ключи у неперемещаемых узлов по пути следования перемещаемого узла
                $sql = "UPDATE `organization_structure` SET `left_key` = `left_key` - {$external_delta} WHERE `left_key` > {$right_key}  AND `left_key` < {$new_parent_right_key}  AND `company_id` = {$company_id}";
                   $db->query($sql);
                $sql = "UPDATE `organization_structure` SET `right_key` = `right_key` - {$external_delta} WHERE `right_key` > {$right_key}  AND `right_key` < {$new_parent_right_key}  AND `company_id` = {$company_id};";
                $db->query($sql);

                // меняем ключи у перемещаемого узла и его потомков
                $sql = "UPDATE `organization_structure` SET `left_key` = {$left_key} + {$delta},`right_key` = {$right_key} + {$delta}  WHERE `left_key` >= {$left_key}  AND `right_key` <= {$right_key}  AND `company_id` = {$company_id};";
        $db->query($sql);

            } else { // если идём вниз по ключам
                // получили дельту для применения к внутренним перемещаемого элементам узла
                $new_right_key = $new_parent_right_key - 1;
                $delta = $right_key - $new_right_key;
                $new_left_key = $left_key - $delta;

                // поменяли ключи у неперемещаемых узлов по пути следования перемещаемого узла
                $sql = "UPDATE `organization_structure` SET `left_key` = `left_key` + {$external_delta} WHERE `left_key` >= {$new_parent_right_key}  AND `left_key` < {$left_key}  AND `company_id` = {$company_id}";
//                 echo $sql;
                $db->query($sql);
                $sql = "UPDATE `organization_structure` SET `right_key` = `right_key` + {$external_delta} WHERE `right_key` >= {$new_parent_right_key}  AND `right_key` < {$left_key}  AND `company_id` = {$company_id};";
//                echo $sql;
                $db->query($sql);
                // меняем ключи у перемещаемого узла и его потомков
                $sql = "UPDATE `organization_structure` SET `left_key` = {$left_key} - {$delta},`right_key` = {$right_key} - {$delta}  WHERE `left_key` >= {$left_key}  AND `right_key` <= {$right_key}  AND `company_id` = {$company_id};";
        $db->query($sql);
            }

            // присваеваю родителя перемещаемому узлу
            $sql = "UPDATE `organization_structure` SET `parent` = {$new_parent} WHERE `id` = {$move_item}";
        $db->query($sql);

            // расставляем правельные левелы
            $sql = "UPDATE organization_structure SET `level` = `level` - ". $level_delta ."
                WHERE left_key >= " . $new_left_key . "
                AND right_key <= " . $new_right_key;
//            echo $sql;
            $db->query($sql);
        }
    }


    private function DeleteNode($delete_item,$company_id){
        global $db;
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $delete_item;
        $result = $db->row($sql);
        $left_key = $result['left_key'];
        $right_key = $result['right_key'];



        $sql="DELETE FROM `organization_structure` WHERE `left_key` >= {$left_key} AND `right` <= {$right_key} AND `company_id` = {$company_id};
                  UPDATE `organization_structure` SET `left_key` = `left_key` - {$right_key} + {$left_key} - 1 WHERE `left_key` > {$right_key} AND `company_id` = {$company_id};
                  UPDATE `organization_structure` SET `right_key` = `right_key` - {$right_key} + {$left_key} - 1 WHERE `right_key` > {$right_key} AND `company_id` = {$company_id};";
//        echo $sql;
//        $db->query($sql);
    }

    // функция добавление элемента в дерево компании
    private  function InsertNode($new_parent_id,$company_id,$kladr_id,$items_control_id,$boss_type){
        global $db;
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $new_parent_id;
        $result = $db->row($sql);
//        $left_key = $result['left_key'];
        $right_key = $result['right_key'];
        $parent_level = $result['level'];

        // добавляем в конец списка
        $sql="UPDATE `organization_structure` SET `left_key` = `left_key` + 2 WHERE `left_key` > {$right_key} AND `company_id` = {$company_id};
                UPDATE `organization_structure` SET `right_key` = `right_key` + 2 WHERE `right_key` >= {$right_key} AND `company_id` = {$company_id};
                INSERT INTO `organization_structure` SET `left_key` = {$right_key},
                                                        `right_key` = {$right_key} + 1,
                                                        `company_id` = {$company_id},
                                                        `kladr_id` = {$kladr_id},
                                                        `items_control_id` = {$items_control_id},
                                                        `boss_type` = {$boss_type},
                                                        `level` = {$parent_level } + 1,
                                                         `parent`={$new_parent_id} ;";
//        echo $sql;
//        $db->query($sql);
    }


    private function TreeCheck($company_id){
        global $db;

        $sql="SELECT * FROM organization_structure WHERE left_key >= right_key AND company_id =".$company_id;
        $result = $db->row($sql);
        $error_item = $result['id'];
        if($error_item!=""){
            echo "Тест №1: Ошибка при запросе - ". $sql ."<br>";
        } else {
            echo "Тест №1: В дереве не найдено ошибок <br>";
        }

        $sql="SELECT
                       t1.*
                FROM
                       organization_structure AS t1,
                       organization_structure AS t2
                WHERE
                       t1.left_key = t2.right_key AND t1.company_id = ". $company_id ." AND t2.company_id =". $company_id;
        $result = $db->row($sql);
        $error_item = $result['id'];
        if($error_item!=""){
            echo "Тест №2: Ошибка при запросе - ". $sql ."<br>";
        } else {
            echo "Тест №2: В дереве не найдено ошибок <br>";
        }

    }

    private  function creator_user_and_pass(){

        global $db, $labro;
        // если есть документ, если есть шаг, если сотрудник не уволен и если действие не завершено
        $sql = "SELECT * FROM employees WHERE id >= 73";

        // перенос утсраевших строк в историю
        $users_array = $db->all($sql);

        foreach ($users_array as $key => $user_array) {
            $pass = $labro->generate_password();
//            $login = $labro->generate_password();
            $role = 3;
            $login = str_ireplace('(SOBAKA)','@',$user_array['email']);
            $sql = "INSERT INTO `users` (         `name`,
                                                  `password`,
                                                  `role_id`,
                                                  `employee_id`,
                                                  `full_name`) VALUES (
                                                   '" . $login. "',
                                                   '" . $pass . "',
                                                   '" . $role. "',
                                                   '" . $user_array['id'] . "',
                                                   '" . $user_array['surname'] . "');";
            $db->query($sql);
        }
    }

    private  function lock_company($id_company){
        global $db;
//    $sql = "SELECT * FROM lock_org_str WHERE id_lock_company =". $id_company;
    $sql = "UPDATE `lock_org_str` SET `status` = 1 WHERE `id_lock_company` = {$id_company}";
    $db->query($sql);
    }

    private  function unlock_company($id_company){
        global $db;
        $sql = "UPDATE `lock_org_str` SET `status` = 0 WHERE `id_lock_company` = {$id_company}";
        $db->query($sql);
    }
//заполнение фатхербэкапп
    public function parent_org(){
        global $db;
    $sql="SELECT organization_structure.id AS child_id,  organization_structure.`level` AS child_level,
            organization_structure.left_key AS child_left, organization_structure.right_key AS child_right,
            Parent.id AS Parent_id,  Parent.`level` AS Parent_level,
            Parent.left_key AS Parent_left, Parent.right_key AS Parent_right
            FROM organization_structure
            LEFT JOIN organization_structure AS Parent ON (organization_structure.left_key > Parent.left_key
                                                                            AND
                                                                            organization_structure.right_key < Parent.right_key
                                                                            AND
                                                                            organization_structure.`level` = (Parent.`level` +1)
                                                                            AND
                                                                            organization_structure.company_id = Parent.company_id
                                                                            )
            WHERE organization_structure.company_id = 15
																";

        $parent_array = $db->all($sql);
        foreach ($parent_array as $parent_item) {
            if($parent_item['Parent_id']== NULL){
                $parent = 0;
            } else {
                $parent = $parent_item['Parent_id'];
            }
            $sql = "UPDATE `organization_structure` SET `parent` = {$parent} WHERE `id` = {$parent_item['child_id']}";
            $db->query($sql);
        }

    }


    public function tffest($doc_link){
        global $db;

        $green = '#00a65a';
        $yellow = '#f39c12';
        $gray =  '#a6a6a6';
        $red = '#f44336';
        $blue = "#4285f4";

        $today = date("Y-m-d");


        $sql="SELECT
/* Вывод даннных */
route_control_step.track_number_id AS id,
  employees.id AS employee_id,
  route_control_step.id AS ID_STEP,
   employees.start_date as employees_start,
   history_docs.date_finish,
     route_control_step.`periodicity`,
   CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
  route_control_step.step_name,
  CASE
	WHEN route_control_step.periodicity IS NULL AND history_docs.date_finish IS NULL
	THEN employees.start_date
	WHEN route_control_step.periodicity IS NOT NULL AND history_docs.date_finish IS NULL
	THEN employees.start_date
	WHEN route_control_step.periodicity IS NULL AND history_docs.date_finish IS NOT NULL
	THEN CAST(history_docs.date_finish AS DATE)
	WHEN route_control_step.periodicity IS NOT NULL AND history_docs.date_finish IS NOT NULL
			AND ((NOW() + INTERVAL 1 MONTH) >  (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
	THEN CAST((history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH) AS DATE)
	WHEN route_control_step.periodicity IS NOT NULL AND history_docs.date_finish IS NOT NULL
			AND ((NOW() + INTERVAL 1 MONTH) <= (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
	THEN CAST(history_docs.date_finish AS DATE)
	END AS START_DATE,

  CASE
	WHEN route_control_step.periodicity IS NOT NULL AND history_docs.date_finish IS NOT NULL
	THEN 1
	WHEN route_control_step.periodicity IS NULL AND history_docs.date_finish IS NOT NULL
			AND NOW() < (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH)
	THEN 1
	ELSE 0
  	END AS progress
  FROM (route_control_step,route_doc,employees)
  LEFT JOIN
    history_docs
    /* история документов по шагам */
    ON (history_docs.step_id = route_control_step.id
       AND
       history_docs.employee_id = employees.id
       /* чтобы выводить все записи без учёта переодики, убрать этот AND*** */
       AND
		 		((route_control_step.periodicity is NULL)
		 		OR
				( NOW() < (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
				OR
				( NOW() < (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
       )
       /* привязка сотрудника к должности */
       LEFT JOIN employees_items_node ON employees_items_node.employe_id = employees.id
       LEFT JOIN organization_structure ON employees_items_node.org_str_id = organization_structure.id
       LEFT JOIN items_control ON items_control.id = organization_structure.kladr_id
       /* находим родительскузел, должность и тип должности */
     LEFT JOIN organization_structure AS org_parent
     ON (org_parent.left_key < organization_structure.left_key AND org_parent.right_key > organization_structure.right_key
     AND org_parent.level =(organization_structure.level - 1) )
     LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
    LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id
     /* узлы с индивидуальными треками */
    LEFT JOIN organization_structure AS TreeOfParents
     ON TreeOfParents.id = route_doc.organization_structure_id
    LEFT JOIN
    /*  получаем id сохранённого файла если он сеть*/
    	(SELECT
			save_temp_files.id AS SaveTempID, history_forms.step_end_time AS TempIdDateStatus, type_form.name AS TempName,
			save_temp_files.employee_id AS TempEmpliD, company_temps.id AS TempCompanyId, step_content.id AS ContentFormId,
			form_step_action.action_name AS ActionName
			FROM
				(save_temp_files, form_status_now, history_forms, type_temp, company_temps, type_form, form_step_action, temps_form_step)
				/* нужны те шаги где есть form_id */
				LEFT JOIN step_content
					ON step_content.form_id = company_temps.id
			WHERE
				save_temp_files.id = form_status_now.save_temps_file_id
				AND
				form_status_now.history_form_id = history_forms.id
				AND
				type_temp.id = company_temps.temp_type_id
				AND
				save_temp_files.company_temps_id = company_temps.id
				AND
				type_form.id = type_temp.temp_form_id
				AND
				temps_form_step.id = form_status_now.track_form_step_now
				AND
				form_step_action.id = temps_form_step.action_form) AS TempTest
				/* приклееваем по совпадению пар сотрудников и шагов */
		ON (TempTest.TempEmpliD=employees.id AND TempTest.ContentFormId = route_control_step.step_content_id)
  WHERE
      /* все роуты с треками */
    route_control_step.track_number_id = route_doc.id
    AND
  /* для всех должностей ... */
   (route_doc.item_type_id IS NULL
          OR
          /* ... или по паре должность  - конкретный сотрудник*/
        route_doc.item_type_id IN
          /* Start Ищем ID Должности из таблици employees_item_node для заданного сотрудника employe.id */
          (SELECT EmplOrg.kladr_id
            FROM
              employees AS Empl, employees_items_node AS EmplItem, organization_structure AS EmplOrg
            WHERE
              Empl.id = EmplItem.employe_id
              AND
              EmplItem.org_str_id=EmplOrg.id
              )
    )
    AND
    /* для всех узлов или конкретных узлов по конкретным сотрудникам */
    (route_doc.organization_structure_id IS NULL
   OR
     (organization_structure.left_key >= TreeOfParents.left_key
     AND
     organization_structure.right_key <= TreeOfParents.right_key)
     )
	AND	organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = organization_structure.company_id
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = org_parent.company_id
    		AND org_parent.company_id = " . $_SESSION['control_company'] . "
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
      GROUP BY employee_id, ID_STEP";

        $briefings = $db->all($sql);
        $result_array = array();



        foreach ($briefings as $key=>$briefing) {
            $result_array [$key]['id'] = $briefing['id'];
            $result_array [$key]['employee_id'] = $briefing['employee_id'];
            $result_array [$key]['ID_STEP'] = $briefing['ID_STEP'];
            $result_array [$key]['employees_start'] = $briefing['employees_start'];
            $result_array [$key]['date_finish']= $briefing['date_finish'];
            $result_array [$key]['periodicity']= $briefing['periodicity'];
            $result_array [$key]['fio'] = $briefing['fio'];
            $result_array [$key]['step_name'] = $briefing['step_name'];
            $result_array [$key]['start'] = $briefing['START_DATE'];
            $result_array [$key]['progress'] = $briefing['progress'];


        }// конец цикла

                foreach ($result_array as $item) {
                    $type = 2;
                    $progress = $item['progress'];
                    $title = $item['step_name'];
                    $dataset = $item['fio'];
                    $start = $item['start'];
                    $company_id = $_SESSION['control_company'];
                    $emp_id = $item['employee_id'];
                    $step_id = $item['ID_STEP'];

                    $sql = "INSERT INTO `calendar` (`event_type`, `dataset`, `title`, `progress`, `start`, `company_id`, `emp_id`, `step_id`)
                        VALUES('" . $type . "',
                                '" . $dataset . "',
                                 '" . $title . "',
                                 '" . $progress . "',
                                  '" . $start . "',
                                   '" . $company_id . "',
                                    '" . $emp_id . "',
                                     '" . $step_id . "');";
                    $db->query($sql);
                }

        return "Всё";
    }
    public function test($doc_link){
        global $db;
        $sql= "SELECT observer_company.id
                    FROM  observer_company
                LEFT JOIN company ON company.id = observer_company.company_id
                WHERE company.id is NULL";

        $briefings = $db->all($sql);
//        foreach ($briefings as $briefing) {
//            $sql="DELETE FROM `laborpro`.`observer_company`  WHERE  `id` =" . $briefing['id'];
//            $db->query($sql);
//        }

    }
}