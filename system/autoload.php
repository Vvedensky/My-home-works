<?php

spl_autoload_register(function ($patch) {

    // получаем класс
    $class = substr($patch,strrpos($patch,'\\'));

    //получаем префикс по простанству имен и приводим в нижний регистр
    $prefix = strtolower(str_replace($class, '', $patch));

    $base_dir = ROOT.'/';

    $relative_class = $prefix.$class;

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
