<?php 
class HomeController {
    public function index()
    {
        $view = "app/views/hello.php";
        include $view;
    }
}