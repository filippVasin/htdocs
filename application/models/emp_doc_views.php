 <?php

class Model_emp_doc_views{
    // Данные для обработки POST запросов;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function emp_file($file_id){
        global $db;
        $flag = "open";
        $page = "";

        $sql="SELECT * FROM save_temp_files WHERE save_temp_files.id =". $file_id;
        $doc_data = $db->row($sql);

        $path = $doc_data['path'];

        $page = ROOT_PATH.'/'.$path;

        $page = file_get_contents($page);

        return $page;
    }



}
