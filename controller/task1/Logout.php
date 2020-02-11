<?php
namespace Controller\Task1;

use Controller\BaseController;

class Logout extends BaseController {

    public function index(){

        if(isset($_COOKIE['token']) || isset($_COOKIE['user'])){
            setcookie("user", '', time()-1, '/');
            setcookie("token", '', time()-1, '/');
        }
        header("Location: ".BASE_URL."task1/login/");
    }

}