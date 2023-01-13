<?php
require '../Modules/categories.php';
require '../Modules/products.php';
require '../Modules/login.php';
require '../Modules/logout.php';
require '../Modules/database.php';
require '../Modules/common.php';

session_start();
//var_dump($_SESSION);
//var_dump($_POST);
$message="";

$request = $_SERVER['REQUEST_URI'];

$params = explode("/", $request);
print_r($request);
$title = "HealthOne";
$titleSuffix = "";

//$params[1] is de action
//$params[2] is een extra getal die de action nodig heeft om zijn taak uit te voeren
switch ($params[1]) {

    case 'categories':
        $titleSuffix = ' | Categories';
        $categories = getCategories();
        //var_dump($categories);die;
        include_once "../Templates/categories.php";
        break;

    case 'category':
        include_once "../Templates/category.php";
        break;

    case 'product':
        include_once "../Templates/product.php";
        break;

    case 'login':
        $titleSuffix = ' | Login';
        include_once "../Templates/login.php";
        break;

    case 'logout':
        $titleSuffix = ' | Logout';
        include_once "../Templates/logout.php";
        break;

    case 'register':
        $titleSuffix = ' | Register';
        include_once "../Templates/register.php";
        break;

    case 'contact':
        $titleSuffix = ' | Contact';
        include_once "../Templates/contact.php";
        break;

    case 'admin':
        include_once ('admin.php');
        break;

    case 'member':
        include_once ('member.php');
        break;

    default:
        $titleSuffix = ' | Home';
        include_once "../Templates/home.php";
}







