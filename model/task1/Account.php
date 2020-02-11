<?php

namespace Model\Task1;

use System\Db;

class Account {

    use Db;

    public function getUsers($user_id){
        return $this->fetchObject("SELECT * FROM users WHERE id = ".(int)$user_id." ");
    }

    public function checkUsers($user_id, $token){
        return $this->fetchObject("SELECT id FROM users WHERE id = ".(int)$user_id." AND token = ".$this->_connection->quote($token)." ");
    }
}