<?php

class Model_action_list
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
        global $db;

        $sql="SELECT * FROM form_step_action";


        $docs_array = $db->all($sql);
        $html = "";
        $html.='<div class="row title">';
        $html.=' <div  class="cell_one">ID</div>
                        <div  class="cell_two">Триггер</div>
                        <div class="cell_three">action</div>
                        <div class="cell_four">Действие</div>
                    </div>';
        foreach ($docs_array as $docs_array_item) {

                $html.='<div class="row row_data" trigger="'. $docs_array_item['action_triger'] .'" action_name="'. $docs_array_item['user_action_name'] .'">';
                $html.=' <div  class="cell_one">' . $docs_array_item['id'] . '</div>
                        <div  class="cell_two">' . $docs_array_item['action_triger'] . '</div>
                        <div class="cell_three">' . $docs_array_item['action_name'] . '</div>
                        <div class="cell_four">' . $docs_array_item['user_action_name'] . '</div>
                    </div>';

        }
        return $html;
    }


    // запрос на дерево позиций
    public function new_action_name(){
        global $db;
        $trigger = $this->post_array['trigger'];
        $action_name = $this->post_array['action_name'];

        $sql = "UPDATE `form_step_action` SET `user_action_name`= '". $action_name ."'  WHERE  `action_triger`='".$trigger ."'";
        $db->query($sql);




        $html ="";
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }


}