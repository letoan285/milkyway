<?php 

class database {
    public $_dbh = '';
    public $_sql = '';
    public $_cursor = '';
    public function __construct(){
        try{
            $this->_dbh = new PDO("mysql:host=127.0.0.1; dbname=shopping_cart_php", "root", "");
            $this->_dbh->query("set names 'utf8'");

        }catch(Exception $e){
            var_dump($e->getMessage());die;
        }
    }


    public function disconnect() {
        $this->_dbh = NULL;
    }
}