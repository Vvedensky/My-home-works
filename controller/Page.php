<?php
namespace Controller;

class Page extends BaseController {

    public $modelPage;
    public $data;

    public function index(){
        //Подключение модели
        $this->modelPage = new \Model\Page();
        $this->modelPage->getUsers();


        echo "Это контроллер Страниц!";

        $this->data = "test";

        $this->view('Page', $this->data);
    }


}
