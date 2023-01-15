<?php
global $params;
//$params[2] is de action en $params[3] een getal die de action nodig heeft
//check if user has role admin
if (!isMember()) {
    logout();
    header ("location:/home");
} else {
    

    switch ($params[2]) {

        case 'home':
            include_once('../Templates/member/home.php');
            break;

        case 'products':
            break;
        case 'profile':
            break;
        case 'editprofile':
            include_once('../Templates/member/editprofile.php');
            break;
        case 'changepassword':
            include_once('../Templates/member/changepassword.php');
            break;

        case 'categories':
            break;

        case 'category':
            break;

        case 'product':
            break;

        case 'review':
            break;

        default:
            header('Location: /member/home');
            break;
    }
}