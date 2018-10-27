<?php
require_once "app/models/User.php"; 
class LoginController {
    public function checkLogin()
    {
        $view = "app/views/auth/login.php";
        include $view;
    }

    public function postLogin()
    {
        $email = $_POST['email'];
        $password = password_verify($_POST['password']);
        $user = User::where(['email', $email])->andWhere('password', $password)->get();

        if(!$user || !count($user)) {
            header('location: ./permission-denied');
        }else {
            $email = $user->email;
            $password = $user->password;
        }
    }
    public function permissionDenied()
    {
        $view = "app/views/auth/503.php";
        include $view;
    }
}