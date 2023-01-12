<?php


class Product
{
    public $id;
    public $name;
    public $picture;
    public $description;
    public $category_id;

    public function __construct()
    {
        settype($this->id, 'integer');
        settype($this->category_id, 'integer');
    }

    public function getProductsByCategoryId($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT products.*, category.picture 
        FROM products 
        INNER JOIN category ON products.category_id = category.id 
        WHERE category.id = :id");

        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        $stmt->execute(['id' => $id]);
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getProductById($id)
    {
        global $pdo;
        $statement = $pdo->prepare('SELECT products.*, category.picture 
        FROM products 
        INNER JOIN category ON products.category_id = category.id 
        WHERE products.id = :id');
        $statement->execute(['id' => $id]);
        $product = $statement->fetch(PDO::FETCH_OBJ);
        $this->id = $product->id;
        $this->name = $product->name;
        $this->picture = $product->picture;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        return $this;
    }

}