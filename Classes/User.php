<?php

class User
{
    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $role;

    public function __construct()
    {
        settype($this->id, 'integer');
    }

    public function register()
    {
        global $pdo;
        $statement = $pdo->prepare('INSERT INTO users (email, password, firstname, lastname, role) VALUES (:email, :password, :first_name, :last_name, :role)');
        $statement->execute([
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->role,
        ]);
    }

    public function login()
    {
        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $statement->execute([
            'email' => $this->email,
            'password' => $this->password,
        ]);
        $user = $statement->fetchObject('User');
        if ($user) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}