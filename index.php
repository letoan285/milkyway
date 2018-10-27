<?php 

$url = isset($_GET['url']) ? $_GET['url']  : '/';

require_once "app/controllers/HomeController.php";
require_once "app/controllers/ProductController.php";
require_once "app/controllers/LoginController.php";

switch($url){
    case '/':
        $ctl = new HomeController();
        $ctl->index();
        break;
    case 'products':
        $ctl = new ProductController();
        $ctl->index();
        break;
    case 'categories':
        $ctl = new CategoryController();
        $ctl->index();
        break;
    case 'admin-login':
        //var_dump('login page');die;
        $ctl = new LoginController();
        $ctl->checkLogin();
        break;
    case 'login-to-system':
        $ctl = new LoginController();
        $ctl->postLogin();
        break;
    case 'permission-denied';
        $ctl = new LoginController();
        $ctl->permissionDenied();
        break;
    default:
        echo 'Not found';
        break;
}