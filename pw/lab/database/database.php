<?php

class DataBase {
    public $connection;
    private static $_instance;

    public static function getInstance(){
        if(!isset(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function __construct() {
        $server = 'localhost';
        $username = 'id18065670_dandres';
        $database = 'id18065670_laboratorio';
        $password = 'I-RO0|w>Dy/i7w/!';
    
        try{
            $this->connection = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
        }catch( PDOException $e) {
            die("Error: " . $e->message());
        }
    }

}
