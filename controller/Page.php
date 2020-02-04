<?php
namespace Controller;

class Page extends BaseController {

    public $modelPage;

    public function index(){
        //Подключение модели
        $this->modelPage = new \Model\Page();
        $this->modelPage->getUsers();


        echo "Это контроллер Страниц!";
    }

    public function view(){

    }
}
