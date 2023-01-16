<?php

function checkLogin():string
{
    global $pdo;

}

function isAdmin():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user->role == "admin")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
}

function isMember():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user->role === "user")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
}

function makeRegistration():string
{

}

function isLogged():bool
{
    //controleer of er ingelogd is
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        return true;
    }
    return false;
}