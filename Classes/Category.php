<?php


class Category
{
    public $id;
    public $name;
    public $picture;

    public $description;

    public function __construct()
    {
        settype($this->id, 'integer');
    }

    public function getCategoryById($id)
    {

        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM category WHERE id = :id');
        $statement->execute(['id' => $id]);
        $category = $statement->fetch(PDO::FETCH_OBJ);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->picture = $category->picture;
        $this->description = $category->description;
        return $this;
    }

    public function getCategoryByProductId($id)
    {
        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM category WHERE id = :id');
        $statement->execute(['id' => $id]);
        $category = $statement->fetch(PDO::FETCH_OBJ);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->picture = $category->picture;
        $this->description = $category->description;
        return $this;
    }
    
}