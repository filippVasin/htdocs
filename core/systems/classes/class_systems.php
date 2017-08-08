<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.03.2017
 * Time: 12:37
 */
class systems{
    // Получаем дату россиского формата;
    public function get_local_date_time($date, $show_time = ''){
        if($date != ''){
            return date('d.m.Y '.($show_time != '' ? 'H:i:s' : ''), strtotime($date));
        }   else{
            return '';
        }
    }
}