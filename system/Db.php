<?php
namespace System;

trait Db{

    private $_connection;
    private static $_instance;

    /**
     * создаем обьект текущего класса
     * @return db
     */
    public static function getInstance()
    {
        // если обьект еще не создан
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * берем конфиги и соединяемся с бд
     * db constructor.
     */
    public function __construct()
    {
        try {
            $file = 'config.ini';
            if (!$settings = parse_ini_file($file, TRUE)){
                echo "file config no isset";
            }

            $this->_connection  = new \PDO('mysql:host='.$settings['database']['host'].';dbname='.$settings['database']['dbname'], $settings['database']['username'], $settings['database']['password']);

            $this->_connection->SetAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $this->_connection;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * запрещаем клонирование обьекта
     */
    private function __clone()
    {
    }

    /**
     * возбращаем соединение с бд
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function fetchObject($query){
        $sth = $this->_connection->prepare($query);
        $sth->execute();
        return $sth->fetchObject();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function query($query){
        $sth = $this->_connection->query($query);
        return $sth->fetchObject();
    }
}