<?php

namespace Model\Task1;

use System\Db;

class Login {

    use Db;

    /**
     * Выбираем пользователя
     * @param $email
     * @param $login
     * @param $password
     * @return mixed
     */
    public function getUsers($email, $login, $password){
        return $this->fetchObject("SELECT * FROM `users` WHERE `email` = ".$this->_connection->quote($email)." AND `login` = ".$this->_connection->quote($login)." AND `password` = ".$this->_connection->quote($password)."");
    }

    /**
     * Запись токена в бд
     * @param $user_id
     * @param $token
     */
    public function updateToken($user_id, $token){
        $this->query("UPDATE `users` SET token = ".$this->_connection->quote($token)." WHERE id = ".(int)$user_id." ");
    }
}