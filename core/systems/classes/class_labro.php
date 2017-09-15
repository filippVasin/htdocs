<?php
/**
 * Created by PhpStorm.
 * User: Filipp
 * Date: 08.08.17
 * Time: 16:48
 */

class labro {

    public function generate_password(){
        $arr = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0');
        // Генерируем пароль
        $pass = "";
        $number = 9; // количество символов
        for($i = 0; $i < $number; $i++)
        {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }

    // получаем ответственного по инструктажам
    public function bailee($emp){
        global $db;
        if(isset($_SESSION['control_company'])){
            $control_company =  $_SESSION['control_company'];
        } else {
            $control_company = 15;
        }
        $sql = "SELECT ORG_chief.id AS ORG_chief_id,ORG_boss.boss_type, ORG_boss.`level` as level,
                chief_employees.id AS chief_employees_id,
                chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
                    chief_items_control.name AS chief_dol
                FROM (organization_structure, employees_items_node)
                LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
                                                                                    AND
                                                                                  ORG_chief.right_key > organization_structure.right_key
                                                                                  AND
                                                                                  ORG_chief.company_id = " . $control_company . " )
                        LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = " . $control_company . "
                                                                                        AND ORG_boss.left_key > ORG_chief.left_key
                                                                                        AND ORG_boss.right_key < ORG_chief.right_key
                                                                                        AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
                                                                                        AND ORG_boss.boss_type > 1
                                                                                            )
                        LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
                        LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
                        LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

                WHERE employees_items_node.employe_id = " . $emp . "
                AND organization_structure.id = employees_items_node.org_str_id
                AND organization_structure.company_id = " . $control_company . "
                AND chief_employees.id is not NULL
                ORDER BY level DESC, boss_type DESC
                LIMIT 1";
        $boss = $db->row($sql);
        return $boss;
    }




    // олучаем почту сотрудника
    public function employees_email($emp){
        global $db;
        $sql = "SELECT email FROM employees WHERE employees.id=". $emp;
        $boss = $db->row($sql);
        $email = $boss['email'];
        return $email;
    }

}