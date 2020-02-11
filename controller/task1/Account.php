<?php
namespace Controller\Task1;

use Controller\BaseController;

class Account extends BaseController {

    public $modelAccount;
    public $modelLogin;
    public $data;

    public function index(){

        $this->modelAccount = new \Model\Task1\Account();

        // проверку в дальнейшем вынести или в базовый контроллер или в папку system
        $auth = $this->modelAccount->checkUsers($_COOKIE["user"], $_COOKIE["token"]);
        if($auth===false){
            header("Location: ".BASE_URL."task1/login/");
        }

        $this->data->user = $this->modelAccount->getUsers($_COOKIE["user"]);
        $this->data->exit = BASE_URL.'task1/logout/';

        $this->view('task1/Account', $this->data);
    }

}
