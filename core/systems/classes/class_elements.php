<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.03.2017
 * Time: 21:00
 */
class elements{
    public function button($caption, $id = '', $class = '', $style = '', $br = '', $option = ''){
        $html = '<div class="button '.$class.'" id="'.$id.'" style="'.$style.'" '.$option.'>'.$caption.'</div>'.($br != '' ? '<br>' : '');

        return $html;
    }

    public function menu_button($caption, $id = '', $class = '', $style = '', $br = '', $link = ''){
        $html = ($link != '' ? '<a href="'.$link.'">' : '').'<div class="menu_button '.$class.'" id="'.$id.'" style="'.$style.'">'.$caption.'</div>'.($link != '' ? '</a>' : '' ).($br != '' ? '<br>' : '');

        return $html;
    }

    public function title($title, $id = ''){
        $html = '<div id="'.$id.'" class="page_title">'.$title.'</div>';

        return $html;
    }

    public function small_title($title, $id = ''){
        $html = '<div id="'.$id.'" class="small_title">'.$title.'</div>';

        return $html;
    }

    public function input($caption = '', $id = '', $class = '', $catch_enter = '', $after_catch_function = '', $password = '', $style = '', $maxlength = '', $other = ''){
        $html = '';
        if ($caption != ''){
            $html = '<div class="caption" style="margin-top: 5px;">'.$caption.'</div>';
        }
        $html .= '<input type="'.($password != '' ? 'password' : 'text').'" id="'.$id.'" class="input '.$class.'" '.($maxlength != '' ? 'maxlength='.$maxlength : '').' style="'.$style.'" '.($other != '' ? $other : '').' '.($catch_enter != '' ? 'onkeydown = "if (event.keyCode == 13) '.$after_catch_function.'()"' : '').'><br>';

        return $html;
    }

    public function date_input($caption = '', $id = '', $class = '', $style = '', $value = ''){
        $html = '';
        if ($caption != ''){
            $html = '<div class="caption" style="margin-top: 5px;">'.$caption.'</div>';
        }
        $html .= '<input id="'.$id.'" type="date" class="input '.$class.'" name="calendar" style="'.$style.'" value="' . ($value == '' ? '' : date('Y-m-d', strtotime(date('Y-m-d').$value))) . '"><br>';

        return $html;
    }

    public function company_item($caption, $id = '', $class = '', $style = '', $option = '', $can_delete = 1){
        $html = '<div class="list_item" id="'.$id.'" style="'.$style.'" '.$option.'>';
        $html .= '<div style="vertical-align: middle;">';
        $html .= $this->button('Включить управление', '', 'company_turn_control '.$class, 'margin-right: 10px;margin-top: 5px;');
        $html .= '</div>';
        $html .= '<div style="vertical-align: middle;">';
        $html .= $caption;
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public function item($caption, $id = '', $class = '', $style = '', $option = '', $can_delete = 1){
        $html = '<div class="list_item" id="'.$id.'" class="'.$class.'" style="'.$style.'" '.$option.'>'.$caption;
        $html .= '</div>';

        return $html;
    }

    public function item_with_checkbox($caption, $id = '', $class = '', $style = '', $option = '', $can_delete = 1){
        $html = '<div class="list_item" id="'.$id.'" class="'.$class.'" style="'.$style.'" '.$option.'>';

        $html .= '<div style="display: inline-block;vertical-align: middle;margin-right: 7px;">';
        $html .= '<input type="checkbox" style="zoom: 2;" '.($class != '' ? 'class="'.$class.'"' : '').'/>';
        $html .= '</div>';

        $html .= '<div style="display: inline-block;vertical-align: middle;">';
        $html .= $caption;
        $html .= '</div>';

        $html .= '</div>';

        return $html;
    }

    public function combobox($caption = '', $options_array, $id = '', $class = '', $style = '', $option = ''){
        $html = '';
        if ($caption != ''){
            $html .= '<div class="caption '.$class.'" style="margin-top: 5px;">'.$caption.'</div>';
        }
        $html .= '<select id="'.$id.'" class="'.$class.'" '.$option.' style="'.$style.'">';
        foreach($options_array as $options){
            $html .= '<option value="'.$options['value'].'" '.($options['selected'] != '' ? 'selected' : '').' '.($options['disabled'] != '' ? 'disabled' : '').'>'.$options['caption'].'</option>';
        }
        $html .= '</select>';

        return $html;
    }
    // кнопки навигации по документы
    public function nav_button($caption = '', $class = ''){
        global $current_template;
        $html = '';
        if ($caption != ''){
            $html = '<div  class="'.$class.'"><div>' .$caption. '</div><img src="/templates/' . $current_template . '/images/down.svg"></div>';
        }
        if ($class == 'up'){
            $html = '<div id="up" class="'.$class.'"><img src="/templates/' . $current_template . '/images/down.svg"><div>' .$caption. '</div></div>';
        }
        if ($class == 'down'){
            $html = '<div id="down" class="'.$class.'"><div>' .$caption. '</div><img src="/templates/' . $current_template . '/images/down.svg"></div>';
        }

        return $html;
    }

    // прогресс бар - пункты
    public function progress_bar( $items= ' '){
        $html = '';
        if ($items != ''){
            $html = '<div class="progress_bar" id="progress_bar"><div class="progress_bar_items">';
            $html .= '<div class="progress_count"><span class="progress_fact">0</span>/<span class="progress_plan">0</span></div>';
            for ($i = 1; $i <= $items; $i++) {
                $html.= '<div class="progress_bar_item"></div>';
            }
            $html .= '</div></div>';
        }
        return $html;
    }
    // прогресс бар - линия(%)
    public function progress_bar_line(){

            $html = '<div class="progress_bar_line" id="progress_bar_line"><span class="progress_line_proc">0%</span>';
            $html .= '<div class="progress_bar_line_front"><div class="progress_bar_line_back"></div></div>';
            $html .= '</div>';

        return $html;
    }
    // информационная панель
    public function info_box($type= ' ',$doc= ' ', $id= ' ',$fio= ' '){

        $html = '<div id="info_box">';
        $html .= '<div class="info_box info_box_type">'.$type.'</div><div class="info_box info_box_doc">'. $_SESSION['step_id'] . ' ' .$doc.'</div><div class="info_box info_box_id">'.$id.'</div><div class="info_box info_box_fio">'.$fio.'</div>';
        $html .= '</div>';

        return $html;
    }
}
