<?php

namespace Model;

use System\Db;

class Page {

    use Db;

    public function getUsers(){
        return $this->query('select * from users');
    }
}