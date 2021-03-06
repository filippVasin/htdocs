<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_documents_download extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // Получаем список документов;
        $docs_list = $this->model->get_doc_list();

        // Поулчаем списко сотрудников;
        $employees_list = $this->model->get_employees_list();

        // Рисуем списк документов;
        $this->view = str_replace('%doc_list%', $docs_list, $this->view);

        // Рисуем список сотрудников;
        $this->view = str_replace('%employees_list%', $employees_list, $this->view);
    }

    // Загурзка докуметов;
    public function download(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;

        // Запускаем метод;
        $result = $this->model->download();
        $this->view = $result;
    }
}