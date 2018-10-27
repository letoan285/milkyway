<?php 

require_once "app/models/BaseModel.php";

class User extends BaseModel {
    public $table = 'users';
    public $columns = ['username', 'email', 'password'];
    public function postLogin()
    {
        echo 'post logi';
    }

    public function getLogin()
    {
        echo 'get login';
    }
}