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
        $statement = $pdo->prepare('INSERT INTO users (email, password, first_name, last_name, role) VALUES (:email, :password, :first_name, :last_name, :role)');
        $statement->execute([
            'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'first_name' => filter_var($this->first_name, FILTER_SANITIZE_STRING),
            'last_name' => filter_var($this->last_name, FILTER_SANITIZE_STRING),
            'role' => filter_var($this->role, FILTER_SANITIZE_STRING)
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

    public function getUserById($id)
    {
        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute(['id' => filter_var($id, FILTER_SANITIZE_NUMBER_INT)]);
        $user = $statement->fetchObject('User');
        return $user;
    }

}