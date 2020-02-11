<?php

namespace Controller;

abstract class BaseController
{
    abstract public function index();

    public function View($tpl, $data){
        require_once 'view/'.$tpl.'.tpl';
    }
}
