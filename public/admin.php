<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header ("location:/home");
} else {
/* $params[2] is de action
   $params[3] is een getal die de delete action nodig heeft
*/
    switch ($params[2]) {

        case 'home':
            include_once('../Templates/admin/home.php');
            break;

        case 'products':
            include_once('../Templates/admin/products.php');
            break;

        case 'add':
            include_once('../Templates/admin/add.php');
            break;

        case 'delete':
            include_once('../Templates/admin/delete.php');
            break;

        case 'edit':
            include_once('../Templates/admin/edit.php');
            break;

        default:
            include_once('../Templates/admin/home.php');
            break;
    }
}