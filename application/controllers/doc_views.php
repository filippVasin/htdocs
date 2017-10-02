<?php

class Controller_doc_views extends Controller{

    public function exec_default(){
        $doc_link = $this->get_params;
        $doc = $this->model->start($doc_link);
        $this->view = str_replace('%doc%', $doc, $this->view);
    }
}