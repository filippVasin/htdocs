<?php

// Класс для работы с базой данных MySQL;
class MySQL {
    
    var $link_id;
    var $query_id;
    var $data = array();
    var $localhost = false;
    
    // Подключение к базе данных;
    function connect($db_host = '', $db_name = '', $db_user = '', $db_password = '') {
        if (empty($this->link_id)) {
                if ($this->link_id = mysqli_connect($db_host, $db_user, $db_password, $db_name)) {
                    return $this->link_id;
                } else {
                    die('Ошибка подключения к базе данных: '.$db_host.' '.$db_name );
                }
            
        }
    }
    
    // Запрос к базе данных;
    function query($sql) {
        if (empty($this->link_id)) die('Нет подключения к базе данных');
        if ($sql == '') die('Пустой запрос');
        $run_query = 1;

        if($run_query == 1){
            if ($this->query_id = mysqli_query($this->link_id, $sql)) {
                mysqli_more_results($this->link_id);
                return $this->query_id;
            } else {
                $this->error($sql);
            }
        }   else{
            //return false;
        }
    }

    // Еще одна функция
    function check($table, $rows, $data){
        // Сбираем строку для запроса;
        $where_line = '';
        foreach($rows as $key => $row){
            $where_line .= "`".$row."` ".($data[$key] == 'NULL' && $data[$key] != '0' ? "IS ".$data[$key] : "= '".$data[$key]."'").($key != count($rows) - 1 ? " AND " : "");
        }
        $sql = "SELECT * FROM `".$table."` WHERE ".$where_line;
        $exist_data = $this->all($sql);

        if(count($exist_data) > 0){
            return false;
        }   else{
            return true;
        }
    }

    // Очистка запроса;
    function free() {
        mysqli_free_result($this->query_id);
        $this->query_id = '';
    }
    
    // Отключение от базы данных;
    function close() {
        mysqli_close($this->link_id);
        $this->link_id = '';
    }
    
    // Загрузка ячейки;
    function one($sql) {
        $this->data = array();
        if ($this->query($sql)) {
            $this->data = mysqli_fetch_array($this->query_id);
        }
        $this->free();
        return $this->data[0];
    }

    // Загрузка строки;
    function row($sql, $type = false) {
        $this->data = array();
        if ($this->query($sql)) {
            $this->data = mysqli_fetch_array($this->query_id, MYSQLI_ASSOC);
        }
        $this->free();
        return $this->data;
    }
    // Иницыалы
    function row_fullname($id, $type = false) {
        $sql ="SELECT CONCAT (`employees`.`surname`, ' ',left(`employees`.`name`,1), '.',left(`employees`.`second_name`,1), '.') AS `fullname`
                         FROM `employees`
                         WHERE `employees`.`id` =".$id ;
        $this->data = array();
        if ($this->query($sql)) {
            $this->data = mysqli_fetch_array($this->query_id, MYSQLI_ASSOC);
        }
        $this->free();
        return $this->data['fullname'];
    }
    
    // Загрузка столбца;
    function col($sql) {
        $this->data = array();
        if ($this->query($sql)) {
            while ($r = mysqli_fetch_array($this->query_id)) {
                $this->data[] = $r[0]; 
            }
        }
        $this->free();
        return $this->data;
    }
    
    // Загрузка ассоциативного массива;
    function assoc($sql) {
        $this->data = array();
        if ($this->query($sql)) {
            while ($r = mysqli_fetch_array($this->query_id)) {
                $this->data[$r[0]] = $r[1]; 
            }
        }
        $this->free();
        return $this->data;
    }
    
    // Загрузка таблицы;
    function all($sql, $count = false) {
        if ($count) $sql = preg_replace("/^SELECT /", "SELECT SQL_CALC_FOUND_ROWS ", $sql)." LIMIT 1000";
        $this->data = array();
        if ($this->query($sql)) {
            while ($r = mysqli_fetch_array($this->query_id, MYSQLI_ASSOC)) {
                $this->data[] = $r; 
            }
        }
        $this->free();
        return $this->data;
    }
    
    // Количество записей;
    function count() {
        $this->data = array();
        if ($this->query("SELECT FOUND_ROWS()")) {
            $this->data = mysqli_fetch_array($this->query_id);
        }
        $this->free();
        return $this->data[0];
    }
    
    // Вывод ошибок;
    function error($sql) {
        die('Ошибка в запросе: <i>'.$sql.'</i><br />'.mysqli_errno($this->link_id).': '.mysqli_error($this->link_id));
    }

}

?>