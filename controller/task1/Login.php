<?php
namespace Controller\Task1;

use Controller\BaseController;

class Login extends BaseController {

    public $modelLogin;
    public $data;

    public function index(){

        $this->data['action'] = $_SERVER['REQUEST_URI'];

        //Подключение модели
        $this->modelLogin = new \Model\Task1\Login();

        if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){

            $password = md5(md5($_POST['password']));

            $result = $this->modelLogin->getUsers( $_POST['email'], $_POST['login'], $password);

            if($result!==false){

                $token = $this->createToken();

                $this->setCucies($result->id, $token);

                $this->modelLogin->updateToken($result->id, $token);

                header("Location: ".BASE_URL."task1/account/");
            } else {
                $this->data['alert'] = "Проверьте введенные данные!";
            }
        } else {
            $this->data['alert'] = "Ведите данные!";
        }

        $this->view('task1/Login', $this->data);
    }

    /**
     * @param int $length
     * @return string
     * @throws \Exception
     */
    function createToken($length = 64){
        $length = ($length < 4) ? 4 : $length;
        return bin2hex(random_bytes(($length-($length%2))/2));
    }

    /**
     * @param $user_id
     * @param $token
     */
    function setCucies($user_id, $token){
        $time = 3600;
        setcookie("user", $user_id, time()+$time, '/');
        setcookie("token", $token, time()+$time, '/');
    }
}