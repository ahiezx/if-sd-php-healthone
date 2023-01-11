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
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->role,
        ]);
        if ($statement->rowCount() > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }


    public function login()
    {
        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute(['email' => $this->email]);
        $user = $statement->fetchObject('User');
        if ($user) {
            if (password_verify($this->password, $user->password)) {
                $_SESSION['user'] = $user;
                return true;
            }
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