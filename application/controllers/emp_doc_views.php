<?php

class Controller_emp_doc_views extends Controller{

    public function exec_default(){
        $file_id = $this->get_params;
        $doc = $this->model->emp_file($file_id);
        $this->view = str_replace('%emp_doc_views%', $doc, $this->view);
    }

}