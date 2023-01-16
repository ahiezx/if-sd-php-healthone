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
        $stmt->execute(['id' => filter_var($id, FILTER_SANITIZE_NUMBER_INT)]);
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
        $statement->execute(['id' => filter_var($id, FILTER_SANITIZE_NUMBER_INT)]);
        $product = $statement->fetch(PDO::FETCH_OBJ);
        if (!$product) {
            return false;
        }
        $this->id = $product->id;
        $this->name = $product->name;
        $this->picture = $product->picture;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        return $this;
    }

    public function update()
    {

        global $pdo;
        $statement = $pdo->prepare('UPDATE products SET name = :name, description = :description, category_id = :category_id WHERE id = :id');
        $statement->execute([
            'name' => filter_var($this->name, FILTER_SANITIZE_STRING),
            'description' => filter_var($this->description, FILTER_SANITIZE_STRING),
            'category_id' => filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT),
            'id' => filter_var($this->id, FILTER_SANITIZE_NUMBER_INT)
        ]);
        return $statement->rowCount() > 0;

    }


}